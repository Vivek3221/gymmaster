<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ManualCollectionsController extends AppController
{
    /**
     * Check if the current logged-in user has access to this module.
     */
    private function checkAccess()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        if (!empty($this->usersdetail['users_type']) && $this->usersdetail['users_type'] == 3) {
            $this->Flash->error(__('Access Denied. Trainers are not allowed to access Manual Collections.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
        }
        $email = strtolower(trim($this->usersdetail['users_email']));
        $db = $this->PlanSubscribers->getConnection();
        $result = $db->execute(
            "SELECT id FROM manual_collection_access WHERE LOWER(email) = ? AND is_active = 1 LIMIT 1",
            [$email]
        )->fetch('assoc');
        if (!$result) {
            $this->Flash->error(__('You do not have permission to access this module.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
        }
        return null;
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('PlanSubscribers');
    }

    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        if (isset($this->Auth)) {
            $this->Auth->allow(['clearCache']);
        }
    }

    // ── INDEX: Show Users list (like Users/index) with Add Plan + Add Payment buttons ──
    public function index()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $this->Users = TableRegistry::get('Users');
        $users_type  = $this->usersdetail['users_type'];
        $users_id    = $this->usersdetail['users_id'];

        $name = '';
        $email = '';
        $norec = 20;
        $status = '';
        $user_type = '';
        $partner   = '';
        $trainer   = '';
        $start_date = '';
        $end_date = '';
        $date_type = 'reg';
        $search = [];

        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Users.name REGEXP'] = $name;
        }

        if (isset($this->request->query['email']) && trim($this->request->query['email']) != "") {
            $email = $this->request->query['email'];
            $search['Users.email REGEXP'] = $email;
        }

        if (isset($this->request->query['status'])) {
            $status = $this->request->query['status'];
            if (trim($status) !== "") {
                $search['Users.active'] = $status;
            }
        }

        if (isset($this->request->query['date_type']) && trim($this->request->query['date_type']) != "") {
            $date_type = $this->request->query['date_type'];
        }

        if (isset($this->request->query['start_date']) && trim($this->request->query['start_date']) != "") {
            $start_date = $this->request->query['start_date'];
        }

        if (isset($this->request->query['end_date']) && trim($this->request->query['end_date']) != "") {
            $end_date = $this->request->query['end_date'];
        }

        if ($date_type !== 'followup') {
            if (!empty($start_date)) {
                $search['Users.created >='] = $start_date . ' 00:00:00';
            }
            if (!empty($end_date)) {
                $search['Users.created <='] = $end_date . ' 23:59:59';
            }
        }

        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        if (isset($this->request->query['user_type']) && trim($this->request->query['user_type']) != "") {
            $user_type = $this->request->query['user_type'];
            $search['Users.user_type'] = $user_type;
        }
        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['Users.partner_id'] = $partner;
        }

        if (isset($this->request->query['trainers']) && trim($this->request->query['trainers']) != "") {
            $trainer = $this->request->query['trainers'];
            $search['Users.trainer_userid'] = $trainer;
        }

        if ($users_type == 2) {
            $search['Users.partner_id'] = $users_id;
        }

        $search['Users.user_type !='] = 4;
        $count = $this->Users->find('all')->where([$search]);
        $count = $count->where(['Users.active !=' => '3', 'Users.user_type !=' => '1']);

        if ($date_type === 'followup') {
            if (!empty($start_date) || !empty($end_date)) {
                $count = $count->where(function ($exp) use ($start_date, $end_date) {
                    $userRemarksTable = TableRegistry::get('UserRemarks');
                    $subquery = $userRemarksTable->find()
                        ->select(['user_id'])
                        ->where(['UserRemarks.user_id = Users.id']);

                    if (!empty($start_date)) {
                        $subquery->where(['UserRemarks.created >=' => $start_date . ' 00:00:00']);
                    }
                    if (!empty($end_date)) {
                        $subquery->where(['UserRemarks.created <=' => $end_date . ' 23:59:59']);
                    }

                    return $exp->exists($subquery);
                });
            }
        }

        // Tab counts: All, Active, Inactive, Enquiry
        $baseCountConditions = ['Users.user_type NOT IN' => ['1', '4'], 'Users.active !=' => '3'];
        if ($users_type == 2) {
            $baseCountConditions['Users.partner_id'] = $users_id;
        }
        $tabCountAll      = $this->Users->find('all')->where($baseCountConditions)->count();
        $tabCountActive   = $this->Users->find('all')->where($baseCountConditions)->where(['Users.active' => '1'])->count();
        $tabCountInactive = $this->Users->find('all')->where($baseCountConditions)->where(['Users.active' => '0'])->count();
        $tabCountEnquiry  = $this->Users->find('all')->where($baseCountConditions)->where(['Users.active' => '2'])->count();

        $this->paginate = [
            'limit' => $norec,
            'order' => ['Users.id' => 'DESC']
        ];
        $users = $this->paginate($count)->toArray();

        $partners =  $this->Users->find('list')
            ->select(['id', 'name'])
            ->where(['user_type' => 2])
            ->toArray();

        $trainers = $this->Users->find('list')
            ->where(['Users.user_type' => 4, 'Users.partner_id' => $users_id]);

        $this->set(compact(
            'users', 'name', 'status', 'norec', 'email', 'user_type', 'users_type',
            'partners', 'partner', 'trainers', 'trainer', 'start_date', 'end_date', 'date_type',
            'tabCountAll', 'tabCountActive', 'tabCountInactive', 'tabCountEnquiry'
        ));
    }

    // ── ADD: Add a manual plan for a specific user (like Users/payment) ──
    public function add($id = '')
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $this->PlanSubscribers = TableRegistry::get('PlanSubscribers');
        $this->Payments        = TableRegistry::get('Payments');
        $this->Users           = TableRegistry::get('Users');

        $planSubscribers       = $this->PlanSubscribers->newEntity();
        $payments              = $this->Payments->newEntity();
        $plandata              = $paymentdata = [];

        $users_type = $this->usersdetail['users_type'];
        $users_name = $this->usersdetail['users_name'];
        $users_id   = $this->usersdetail['users_id'];

        $user       = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($users_type == 2 && $user->partner_id != $users_id) {
            $this->Flash->error(__('You are not authorized to access this user.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->getData();
            if (!empty($data['password'])) {
                if ($data['password'] != $data['cpassword']) {
                    return $this->redirect(['action' => 'add', $id]);
                }
                $data['password'] = md5($data['password']);
            }
            if (isset($this->request->data['images']['name']) && $data['images']['name'] != "") {
                $flname = time() . str_replace(" ", "", $data['images']['name']);
                $flpath = WWW_ROOT . "img/" . $flname;
                if (move_uploaded_file($data['images']['tmp_name'], $flpath)) {
                    $data['photo'] = $flname;
                }
            }
            if (!empty($data['trainer_userid'])) {
                $user->trainer_userid = $data['trainer_userid'];
            }
            $user                 = $this->Users->patchEntity($user, $data);
            $useradd              = $this->Users->save($user);
            if ($useradd) {
                // insert into plan_subscribers
                $plandata['user_id']         = $user->id;
                $plandata['partner_id']      = $this->usersdetail['users_id'];
                $plandata['plan_name']       = $data['plan_name'];
                $plandata['fee']             = $data['fee'];
                $plandata['currency']        = 'INR';
                $plandata['collection_type'] = 'manual';
                $plandata['plan_expire_date'] = date('Y-m-d H:i:s', strtotime($data['plan_expire_date']));
                $plandata['payment_due_date'] = !empty($data['payment_due_date']) ? date('Y-m-d H:i:s', strtotime($data['payment_due_date'])) : null;
                if (!empty($data['subscription_start_date'])) {
                    $plandata['subscription_start_date'] = date('Y-m-d', strtotime($data['subscription_start_date']));
                }
                if (!empty($data['reminder_date'])) {
                    $plandata['reminder_date'] = date('Y-m-d', strtotime($data['reminder_date']));
                }

                // Track remaining fee for manual collections list & quick-payment
                $payAmount = (int)($data['amount'] ?? 0);
                $plandata['paid_fee']   = $payAmount;
                $plandata['remain_fee'] = (int)$data['fee'] - $payAmount;

                $planSubscribers             = $this->PlanSubscribers->patchEntity($planSubscribers, $plandata);
                $planSubscribers->collection_type = 'manual';

                $planSubscribersAdd = $this->PlanSubscribers->save($planSubscribers);

                if ($planSubscribersAdd) {
                    // Direct SQL update to guarantee collection_type = 'manual' in MySQL DB on live servers
                    $db = $this->PlanSubscribers->getConnection();
                    $db->execute("UPDATE plan_subscribers SET collection_type = 'manual' WHERE id = ?", [(int)$planSubscribersAdd->id]);
                } else {
                    $errors = $planSubscribers->errors();
                    $this->Flash->error(__('The plan subscriber could not be saved. Errors: ') . json_encode($errors));
                    return $this->redirect(['controller' => 'ManualCollections', 'action' => 'add', $user_id]);
                }

                // insert into payments
                if ($payAmount > 0) {
                    $paymentdata['user_id']             = $user->id;
                    $paymentdata['partner_id']          = $this->usersdetail['users_id'];
                    $paymentdata['plan_subscriber_id']  = $planSubscribers->id;
                    $paymentdata['amount']              = $payAmount;
                    $paymentdata['currency']            = 'INR';
                    $payments    = $this->Payments->patchEntity($payments, $paymentdata);
                    $payments->mode_ofpay = $data['mode_ofpay'];
                    if (!$this->Payments->save($payments)) {
                        $errors = $payments->errors();
                        $this->Flash->error(__('Payment could not be saved. Errors: ') . json_encode($errors));
                    }
                }

                $this->Flash->success(__('The plan has been saved.'));
                return $this->redirect(['controller' => 'ManualCollections', 'action' => 'index']);
            }
            
            // Print error if save fails to diagnose
            $errors = $user->errors();
            $this->Flash->error(__('The user could not be saved. Errors: ') . json_encode($errors));
        }
        $user_id = $id;
        $trainers = $this->Users->find('list')
            ->where(['Users.user_type' => 4, 'Users.partner_id' => $users_id]);

        $plansTable = TableRegistry::get('Plans');
        $planConditions = ['Plans.active' => 1];
        if ($users_type != 1) {
            $planConditions['Plans.partner_id'] = $users_id;
        }
        $availablePlans = $plansTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'title'
        ])->where($planConditions)->toArray();

        $this->set(compact('user_id', 'user', 'trainers', 'users_type', 'availablePlans'));
    }

    // ── ADD PAYMENT: Add payment for an existing plan of a user (like Users/addPayment) ──
    public function addPayment($userid)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $this->Payments = TableRegistry::get('Payments');
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];

        $user = TableRegistry::get('Users')->get($userid);
        if ($users_type == 2 && $user->partner_id != $users_id) {
            $this->Flash->error(__('You are not authorized to access this user.'));
            return $this->redirect(['action' => 'index']);
        }

        $targetPartnerId = !empty($user->partner_id) ? $user->partner_id : ($users_type == 2 ? $users_id : (isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : $users_id));

        $payment = $this->Payments->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['partner_id'] = $targetPartnerId;
            $data['currency'] = 'INR';
            $payment = $this->Payments->patchEntity($payment, $data);
            $payment->mode_ofpay = $data['mode_ofpay'];
            if ($this->Payments->save($payment)) {
                 $PlanSubscribers = TableRegistry::get('PlanSubscribers');
                  $ps = $PlanSubscribers->get($data['plan_subscriber_id']);
                  $ps->collection_type = 'manual';
                  if ($PlanSubscribers->save($ps, ['validate' => false])) {
                      $db = $PlanSubscribers->getConnection();
                      $db->execute("UPDATE plan_subscribers SET collection_type = 'manual' WHERE id = ?", [(int)$data['plan_subscriber_id']]);
                      $this->Flash->success(__('The payment has been saved.'));
                      return $this->redirect(['action' => 'index']);
                  } else {
                     $errors = $ps->errors();
                     $this->Flash->error(__('Payment saved, but plan subscriber could not be updated. Errors: ') . json_encode($errors));
                 }
             }
             $this->Flash->error(__('The payment could not be saved. Please, try again.'));
         }

        $search = [];
        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        if (!empty($search)) {
            $users = $this->Payments->Users->find(['list', 'contain' => ['Users', 'Partners']])
                ->where([$search]);
        } else {
            $users = $this->Payments->Users->find(['list', 'contain' => ['Users', 'Partners']]);
        }

        $partners = $this->Payments->Partners->find('list');
        $planSubscribers = $this->Payments->PlanSubscribers->find('list')
            ->where(['user_id' => $userid, 'collection_type' => 'manual']);

        $this->set(compact('payment', 'users', 'partners', 'planSubscribers', 'userid'));
    }

    /*
     * show plan list select input using ajax
     */
    public function showPlanList($userid)
    {
        $this->viewBuilder()->layout("ajax");
        $this->Payments = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $planSubscribers = $this->Payments->PlanSubscribers->find('list', ['limit' => 200])
            ->where(['user_id' => $userid, 'partner_id' => $this->usersdetail['users_id'], 'collection_type' => 'manual']);
        $this->set(compact('planSubscribers', 'userid'));
    }

    /*
     * show plan details using ajax
     */
    public function showPlanDetails($planid)
    {
        $this->viewBuilder()->layout("ajax");
        $this->Payments = TableRegistry::get('Payments');
        $this->PlanSubscribers = TableRegistry::get('PlanSubscribers');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $planSubscribers = $this->PlanSubscribers->find('all')
            ->select(['id', 'fee', 'payment_due_date', 'plan_expire_date'])
            ->where(['id' => $planid])->first();
        $paidAmount = $this->Payments->find('all');
        $paidAmount = $paidAmount->select(['sum' => $paidAmount->func()->sum('amount')])
            ->where(['plan_subscriber_id' => $planSubscribers->id])->first();
        $paid = 0;
        if (!empty($paidAmount->sum)) {
            $paid = $paidAmount->sum;
        }
        $remaining = $planSubscribers->fee - $paid;
        if (!empty($this->request->query('amount'))) {
            $updateLimit = $remaining + $this->request->query('amount');
            $paid = $paid - $this->request->query('amount');
            $remaining = $remaining + $this->request->query('amount');
        }
        echo '<div class="col-sm-12"><strong>Selected Plan Details:</strong></div>';
        echo '<div class="col-sm-4"><strong>Total Fee:</strong> INR ' . $planSubscribers->fee . '</div>';
        echo '<div class="col-sm-4"><strong>Paid Amount:</strong> INR ' . $paid . '</div>';
        echo '<div class="col-sm-4"><strong>Remaining Amount:</strong> INR ' . $remaining . '</div>';
        echo ' <input type="hidden" id="fee" name="fee" value="' . $remaining . '">';
        echo '<div class="col-sm-4"><strong>Payment Due Date:</strong> ' . date('d-m-Y', strtotime($planSubscribers->payment_due_date)) . '</div>';
        echo '<div class="col-sm-4"><strong>Plan Expire Date:</strong> ' . date('d-m-Y', strtotime($planSubscribers->plan_expire_date)) . '</div>';
        exit;
    }

    // ── PAY: Pay pending fee on a specific plan subscriber (direct link) ──
    public function pay($id = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $planSubscriber = $this->PlanSubscribers->get($id, ['contain' => ['Users']]);

        if ($planSubscriber->collection_type !== 'manual') {
            $this->Flash->error(__('Invalid action for this subscription type.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data      = $this->request->getData();
            $payAmount = (float)($data['payment_amount'] ?? 0);

            if ($payAmount <= 0) {
                $this->Flash->error(__('Please enter a valid payment amount.'));
            } elseif ($payAmount > $planSubscriber->remain_fee) {
                $this->Flash->error(__('Amount cannot exceed remaining fee of ₹' . $planSubscriber->remain_fee));
            } else {
                $Payments = TableRegistry::get('Payments');
                $payment  = $Payments->newEntity();
                $payment->plan_subscriber_id = $planSubscriber->id;
                $payment->user_id            = $planSubscriber->user_id;
                $payment->partner_id         = $planSubscriber->partner_id ?? null;
                $payment->amount             = $payAmount;
                $payment->currency           = $planSubscriber->currency ?? 'INR';
                $payment->mode_ofpay         = $data['mode_ofpay'] ?? 0;

                if ($Payments->save($payment)) {
                    $planSubscriber->paid_fee  += $payAmount;
                    $planSubscriber->remain_fee = $planSubscriber->fee - $planSubscriber->paid_fee;
                    if (!empty($data['payment_due_date'])) {
                        $planSubscriber->payment_due_date = $data['payment_due_date'];
                    }
                    $this->PlanSubscribers->save($planSubscriber);
                    $db = $this->PlanSubscribers->getConnection();
                    $db->execute("UPDATE plan_subscribers SET collection_type = 'manual' WHERE id = ?", [(int)$planSubscriber->id]);
                    $this->Flash->success(__('Payment of ₹' . $payAmount . ' recorded.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Could not record payment.'));
            }
        }

        $getModPayment = ['0' => 'By Cash', '1' => 'By Check', '2' => 'By Online'];
        $this->set(compact('planSubscriber', 'getModPayment'));
    }

    // ── VIEW: View a single plan subscriber entry ──
    public function view($id = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $planSubscriber = $this->PlanSubscribers->get($id, [
            'contain' => ['Users', 'Partners', 'Payments']
        ]);
        if ($planSubscriber->collection_type !== 'manual') {
            return $this->redirect(['action' => 'index']);
        }
        $this->set('planSubscriber', $planSubscriber);
    }

    // ── REPORT ──────────────────────────────────────────────────────────────
    public function report()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $this->Users = TableRegistry::get('Users');
        $search = ['PlanSubscribers.collection_type' => 'manual'];
        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];

        if ($users_type == 2) {
            $search['PlanSubscribers.partner_id'] = $users_id;
        }
        if (!empty($this->request->query['name'])) {
            $name = trim($this->request->query['name']);
            $search['OR'] = ['Users.name REGEXP' => $name, 'PlanSubscribers.plan_name REGEXP' => $name];
        }

        $planSubscribers = $this->PlanSubscribers->find('all')
            ->contain(['Users', 'Partners', 'Payments'])
            ->where($search)
            ->where(['Users.active !=' => '3', 'Users.user_type !=' => '1'])
            ->order(['PlanSubscribers.id' => 'DESC'])
            ->all();

        $groupedSubscribers = [];
        foreach ($planSubscribers as $ps) {
            $years = [];
            if ($ps->created) $years[] = $ps->created->format('Y');
            if (!empty($ps->payments)) {
                foreach ($ps->payments as $payment) {
                    if ($payment->created) $years[] = $payment->created->format('Y');
                }
            }
            $years = array_unique($years);
            foreach ($years as $year) $groupedSubscribers[$year][] = $ps;
        }
        ksort($groupedSubscribers);

        $reportData = [];
        foreach ($groupedSubscribers as $year => $subscribersInYear) {
            $subIds = array_column(array_map(function($ps){ return ['id'=>$ps->id]; }, $subscribersInYear), 'id');
            $subscriberPayments = [];
            $paymentDates = [];
            if (!empty($subIds)) {
                $paymentsTable = TableRegistry::get('Payments');
                $allPayments = $paymentsTable->find('all')
                    ->select(['created', 'amount', 'plan_subscriber_id'])
                    ->where(['plan_subscriber_id IN' => $subIds])
                    ->toArray();
                foreach ($allPayments as $p) {
                    $dateStr = $p->created->format('d-m-Y');
                    $paymentDates[$dateStr] = $dateStr;
                    $subId = $p->plan_subscriber_id;
                    if (!isset($subscriberPayments[$subId])) $subscriberPayments[$subId] = [];
                    if (!isset($subscriberPayments[$subId][$dateStr])) $subscriberPayments[$subId][$dateStr] = 0;
                    $subscriberPayments[$subId][$dateStr] += $p->amount;
                }
                uksort($paymentDates, function($a, $b){ return strtotime($a) - strtotime($b); });
            }

            $earliestJoin = null; $latestExpire = null;
            foreach ($subscribersInYear as $ps) {
                $jt = strtotime($ps->created->format('Y-m-d'));
                $et = strtotime($ps->plan_expire_date->format('Y-m-d'));
                if ($earliestJoin === null || $jt < $earliestJoin) $earliestJoin = $jt;
                if ($latestExpire === null || $et > $latestExpire) $latestExpire = $et;
            }

            $months = [];
            if ($earliestJoin !== null && $latestExpire !== null) {
                $current = strtotime(date('Y-m-01', $earliestJoin));
                $end     = strtotime(date('Y-m-01', $latestExpire));
                while ($current <= $end) { $months[] = date('Y-m-t', $current); $current = strtotime('+1 month', $current); }
            }

            $dataRows = [];
            $monthActiveCounts = array_fill_keys($months, 0);
            $monthTotals       = array_fill_keys($months, 0);

            foreach ($subscribersInYear as $row) {
                $startDateStr = (!empty($row->subscription_start_date)) ? $row->subscription_start_date->format('Y-m-d') : $row->created->format('Y-m-d');
                $endDateStr   = $row->plan_expire_date->format('Y-m-d');
                $totalDays    = max(1, round((strtotime($endDateStr) - strtotime($startDateStr)) / 86400) + 1);
                $dailyRate    = $row->fee / $totalDays;

                $start = new \DateTime($startDateStr);
                $end = new \DateTime($endDateStr);
                $diff = $start->diff($end);
                $monthsCount = $diff->y * 12 + $diff->m;
                if ($diff->d >= 1) {
                    $monthsCount += 1;
                }
                if ($monthsCount <= 0) {
                    $monthsCount = 1;
                }

                $today = strtotime(date('Y-m-d'));
                $expireTime = strtotime($endDateStr);
                $pendingDays = 0;
                if ($expireTime > $today) {
                    $pendingDays = round(($expireTime - $today) / 86400);
                }
                $pendingAmount = round($pendingDays * $dailyRate, 2);

                $subscriberRow = [
                    'id' => $row->id, 
                    'name' => ucwords($row->user->name),
                    'joining_date' => (!empty($row->subscription_start_date)) ? $row->subscription_start_date->format('d-m-Y') : $row->created->format('d-m-Y'),
                    'membership' => $monthsCount,
                    'total_amount' => $row->fee,
                    'paid_amount'  => $row->paid_fee, 
                    'due_amount' => $row->remain_fee,
                    'end_date'     => date('d-m-Y', strtotime($row->plan_expire_date)),
                    'pending_days' => $pendingDays,
                    'pending_amount' => $pendingAmount,
                    'days'         => $totalDays, 
                    'daily_amt' => round($dailyRate, 2),
                    'months' => [], 
                    'payments' => []
                ];
                foreach ($months as $m) {
                    $mStart = date('Y-m-01', strtotime($m)); $mEnd = $m;
                    $oStart = max(strtotime($startDateStr), strtotime($mStart));
                    $oEnd   = min(strtotime($endDateStr),   strtotime($mEnd));
                    $val = ($oStart <= $oEnd) ? round((round(($oEnd - $oStart) / 86400) + 1) * $dailyRate, 2) : 0;
                    $subscriberRow['months'][$m] = $val;
                    if ($val > 0) { $monthActiveCounts[$m]++; $monthTotals[$m] += $val; }
                }
                foreach ($paymentDates as $d) {
                    $subscriberRow['payments'][$d] = $subscriberPayments[$row->id][$d] ?? 0;
                }
                $dataRows[] = $subscriberRow;
            }
            $reportData[$year] = compact('months', 'paymentDates', 'dataRows', 'monthActiveCounts', 'monthTotals');
        }
        $this->set(compact('reportData'));
    }

    // ── Manage Access ────────────────────────────────────────────────────────
    public function manageAccess()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $currentUserEmail = strtolower(trim($this->usersdetail['users_email'] ?? ''));
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        if (!in_array($currentUserEmail, $allowedEmails)) {
            $this->Flash->error(__('You are not authorized to manage access. Only designated administrators can manage access.'));
            return $this->redirect(['action' => 'index']);
        }

        $db = $this->PlanSubscribers->getConnection();

        if ($this->request->is('post')) {
            $data   = $this->request->getData();
            $action = $data['form_action'] ?? '';

            if ($action === 'add' && !empty($data['new_email'])) {
                $email = strtolower(trim($data['new_email']));
                $db->execute(
                    "INSERT INTO manual_collection_access (email, added_by, is_active, created, modified) VALUES (?, ?, 1, NOW(), NOW()) ON DUPLICATE KEY UPDATE is_active=1, modified=NOW()",
                    [$email, $this->usersdetail['users_email']]
                );
                $this->Flash->success(__('Email added successfully.'));
            } elseif ($action === 'remove' && !empty($data['email_id'])) {
                $db->execute("UPDATE manual_collection_access SET is_active=0, modified=NOW() WHERE id=?", [(int)$data['email_id']]);
                $this->Flash->success(__('Access removed.'));
            }
            return $this->redirect(['action' => 'manageAccess']);
        }

        $accessList = $db->execute("SELECT * FROM manual_collection_access ORDER BY is_active DESC, created DESC")->fetchAll('assoc');
        $this->set(compact('accessList'));
    }

    /**
     * Clear all CakePHP caches
     */
    public function clearCache()
    {
        $this->autoRender = false;

        $clearedConfigs = [];
        try {
            $configs = \Cake\Cache\Cache::configured();
            foreach ($configs as $config) {
                \Cake\Cache\Cache::clear(false, $config);
                $clearedConfigs[] = $config;
            }
        } catch (\Exception $e) {
            // ignore
        }

        $deletedCount = 0;
        try {
            $dir = new \Cake\Filesystem\Folder(TMP . 'cache');
            $files = $dir->findRecursive('.*');
            foreach ($files as $file) {
                if (is_file($file) && !in_array(basename($file), ['empty', '.gitkeep', 'index.php'])) {
                    if (@unlink($file)) {
                        $deletedCount++;
                    }
                }
            }
        } catch (\Exception $e) {
            // ignore
        }

        echo "<div style='font-family: Arial, sans-serif; padding: 30px; line-height: 1.6; max-width: 600px; margin: 40px auto; background: #e8f5e9; border: 1px solid #a5d6a7; border-radius: 8px; color: #1b5e20;'>";
        echo "<h2 style='margin-top:0; color:#2e7d32;'>✓ CakePHP Cache Cleared Successfully!</h2>";
        echo "<p><strong>Cleared Cache Configs:</strong> " . implode(', ', $clearedConfigs) . "</p>";
        echo "<p><strong>Deleted Cache Files:</strong> $deletedCount file(s) removed from <code>tmp/cache/</code>.</p>";
        echo "<p style='margin-bottom:0; color:#333;'>Database model schema and query cache have been refreshed. Please try adding Manual Collection now!</p>";
        echo "</div>";
        exit();
    }

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
