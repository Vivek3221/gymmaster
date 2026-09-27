<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Http\Client;
use Cake\Mailer\Email;
use Cake\Core\Plugin;
use Cake\Filesystem\Folder;
use Cake\Routing\Router;
use Cake\Utility\Security;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Common');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // $this->Users->userAuth = $this->UserAuth;
        $this->Auth->allow(['index', 'add', 'view', 'edit', 'login', 'status', 'adminLogin', 'verifiedUpdate', 'logout', 'payment', 'forgetPassword', 'forgotPassword', 'resetPassword', 'siteMap', 'about', 'contact', 'sendContact', 'userProfile', 'saveRemark', 'getRemarks', 'softDelete', 'exportContacts', 'clearCache', 'expiredUsers']);
    }

    public function about()
    {
        // Auto renders about.ctp
    }

    public function contact()
    {
        // Auto renders contact.ctp
    }

    /**
     * Handle contact form submission via AJAX.
     * Sends details to makeover72@gmail.com via SMTP.
     */
    public function sendContact()
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post']);

        // Read directly from $_POST — most reliable for multipart/form-data AJAX
        $senderName   = isset($_POST['name'])    ? trim($_POST['name'])    : '';
        $senderEmail  = isset($_POST['email'])   ? trim($_POST['email'])   : '';
        $senderPhone  = isset($_POST['phone'])   ? trim($_POST['phone'])   : '';
        $senderMessage = isset($_POST['message']) ? trim($_POST['message']) : '';

        // Basic validation
        if (empty($senderName) || empty($senderEmail) || empty($senderMessage)) {
            echo json_encode(['success' => false, 'msg' => 'Please fill in all required fields.']);
            exit();
        }
        if (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'msg' => 'Please enter a valid email address.']);
            exit();
        }

        $toEmail = 'makeover72@gmail.com';
        $subject = 'New Contact Enquiry from ' . $senderName . ' | MakeOver Star HIIT';

        $viewVars = [
            'senderName'    => $senderName,
            'senderEmail'   => $senderEmail,
            'senderPhone'   => $senderPhone,
            'senderMessage' => $senderMessage,
        ];

        try {
            $email = new Email();
            $email->transport('default');
            $email->emailFormat('html')
                ->template('contact_inquiry')
                ->from(['support@datamonitering.com' => 'MakeOver Star HIIT'])
                ->to($toEmail)
                //   ->cc('singhabhi841417@gmail.com')
                ->subject($subject)
                ->viewVars($viewVars)
                ->send();

            echo json_encode(['success' => true, 'msg' => 'Your message has been sent successfully! We will get back to you soon.']);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'msg' => 'Failed to send message. Please try again or contact us directly.']);
        }
        exit();
    }

    public function userProfile()
    {
        if (empty($this->usersdetail['users_id'])) {
            return $this->redirect('/');
        }
        $userId = $this->usersdetail['users_id'];
        $Users  = TableRegistry::get('Users');
        $user   = $Users->get($userId);

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->data;

            // Update name
            if (!empty($data['users_name'])) {
                $user->name = trim($data['users_name']);
            }

            // Update password only if provided
            if (!empty($data['new_password'])) {
                if ($data['new_password'] !== $data['confirm_password']) {
                    $this->Flash->error('Passwords do not match.');
                    $this->set(compact('user'));
                    return;
                }
                $user->password = md5($data['new_password']);
            }

            if ($Users->save($user)) {
                // Refresh session with updated name
                $session = $this->request->session()->read('users');
                $session['users_name'] = $user->name;
                $this->request->session()->write('users', $session);
                $this->Cookie->write('users', $session);
                $this->Flash->success('Profile updated successfully!');
                return $this->redirect(['action' => 'userProfile']);
            } else {
                $this->Flash->error('Could not update profile. Please try again.');
            }
        }

        $this->set(compact('user'));
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        //pr($this->usersdetail['users_email']); die;

        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
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
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];


        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Users.name REGEXP'] = $name;
        }

        if (isset($this->request->query['email']) && trim($this->request->query['email']) != "") {
            $email = $this->request->query['email'];
            $search['Users.email REGEXP'] = $email;
        }

        $mobile = '';
        if (isset($this->request->query['mobile']) && trim($this->request->query['mobile']) != "") {
            $mobile = $this->request->query['mobile'];
            $search['Users.mobile_no REGEXP'] = $mobile;
        }

        if (isset($this->request->query['status'])) {
            $status = $this->request->query['status'];
            if (trim($status) !== "") {
                if ($status !== 'expired' && $status !== '3') {
                    $search['Users.active'] = $status;
                }
            }
        } else {
            $status = '';
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

        $front_desk_id = '';
        if (isset($this->request->query['front_desk_id']) && trim($this->request->query['front_desk_id']) != "") {
            $front_desk_id = $this->request->query['front_desk_id'];
            $search['Users.added_by'] = $front_desk_id;
        }

        $isExpiredFilter = ($status === 'expired' || $status === '3' || $date_type === 'expiry');
        if ($date_type !== 'followup' && !$isExpiredFilter) {
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
        if (isset($this->request->query['users']) && trim($this->request->query['users']) != "") {
            $news_user = date('Y-m-d');
            $search['Users.dob ='] = $news_user;
        }

        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        } elseif (isset($users_type) && ($users_type == 4)) {
            $ptUserIds = TableRegistry::get('UserPtSubscriptions')->find()->select(['user_id'])->where(['trainer_id' => $users_id]);
            $search['OR'] = [
                'Users.trainer_userid' => $users_id,
                'Users.id IN' => $ptUserIds
            ];
        } elseif (isset($users_type) && ($users_type == 5)) {
            $partnerId = isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : 0;
            $search['Users.partner_id'] = $partnerId;
            $search['Users.added_by'] = $users_id;
        }
        //   pr($search);exit;
        $search['Users.user_type NOT IN'] = [4, 5];
        if (isset($search)) {

            $count = $this->Users->find('all')
                ->where([$search]);
        } else {
            $count = $this->Users->find('all');
        }

        $count = $count->where(['Users.active !=' => '3', 'Users.user_type !=' => '1', 'Users.user_type NOT IN' => [4, 5]])
            ->contain(['AddedByUsers']);

        $planSubscribersTable = TableRegistry::get('PlanSubscribers');
        $activeSubquery = $planSubscribersTable->find()
            ->select(['user_id'])
            ->where([
                'PlanSubscribers.user_id = Users.id',
                'PlanSubscribers.plan_expire_date >=' => date('Y-m-d')
            ]);
        $expiredSubquery = $planSubscribersTable->find()
            ->select(['user_id'])
            ->where([
                'PlanSubscribers.user_id = Users.id',
                'PlanSubscribers.plan_expire_date <' => date('Y-m-d')
            ]);

        if ($isExpiredFilter) {
            $count = $count->where(function ($exp) use ($expiredSubquery, $activeSubquery) {
                return $exp->and_([
                    $exp->exists($expiredSubquery),
                    $exp->notExists($activeSubquery)
                ]);
            });

            if (!empty($start_date) || !empty($end_date)) {
                $count = $count->where(function ($exp) use ($start_date, $end_date) {
                    $psTable = TableRegistry::get('PlanSubscribers');
                    $sub = $psTable->find()->select(['user_id'])->where(['PlanSubscribers.user_id = Users.id']);
                    if (!empty($start_date)) {
                        $sub->where(['PlanSubscribers.plan_expire_date >=' => $start_date . ' 00:00:00']);
                    }
                    if (!empty($end_date)) {
                        $sub->where(['PlanSubscribers.plan_expire_date <=' => $end_date . ' 23:59:59']);
                    }
                    return $exp->exists($sub);
                });
            }
        }

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

        $partners =  $this->Users->find('list')
            ->select(['id', 'name'])
            ->where(['user_type' => 2])
            ->toArray();

        // --- Tab counts: All, Active, Inactive, Enquiry, Expired ---
        $baseCountConditions = ['Users.user_type NOT IN' => ['1', '4', '5'], 'Users.active !=' => '3'];
        if (isset($users_type) && ($users_type == 2)) {
            $baseCountConditions['Users.partner_id'] = $users_id;
        } elseif (isset($users_type) && ($users_type == 4)) {
            $ptUserIds = TableRegistry::get('UserPtSubscriptions')->find()->select(['user_id'])->where(['trainer_id' => $users_id]);
            $baseCountConditions['OR'] = [
                'Users.trainer_userid' => $users_id,
                'Users.id IN' => $ptUserIds
            ];
        } elseif (isset($users_type) && ($users_type == 5)) {
            $partnerId = isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : 0;
            $baseCountConditions['Users.partner_id'] = $partnerId;
            $baseCountConditions['Users.added_by'] = $users_id;
        }
        $tabCountAll      = $this->Users->find('all')->where($baseCountConditions)->count();
        $tabCountActive   = $this->Users->find('all')->where($baseCountConditions)->where(['Users.active' => '1'])->count();
        $tabCountInactive = $this->Users->find('all')->where($baseCountConditions)->where(['Users.active' => '0'])->count();
        $tabCountEnquiry  = $this->Users->find('all')->where($baseCountConditions)->where(['Users.active' => '2'])->count();

        $tabCountExpired  = $this->Users->find('all')
            ->where($baseCountConditions)
            ->where(function ($exp) use ($expiredSubquery, $activeSubquery) {
                return $exp->and_([
                    $exp->exists($expiredSubquery),
                    $exp->notExists($activeSubquery)
                ]);
            })->count();
        // --------------------------------------------------

        $this->paginate = ['limit' => $norec, 'order' => ['Users.id' => 'DESC']];

        $users = $this->paginate($count)->toArray();

        $userIds = [];
        foreach ($users as $u) {
            $userIds[] = $u->id;
        }
        $latestPlans = [];
        if (!empty($userIds)) {
            $allUserSubs = $planSubscribersTable->find('all')
                ->where(['user_id IN' => $userIds])
                ->order(['id' => 'DESC'])
                ->toArray();
            foreach ($allUserSubs as $sub) {
                if (!isset($latestPlans[$sub->user_id])) {
                    $latestPlans[$sub->user_id] = $sub;
                }
            }
        }

        $trainerPartnerId = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($this->usersdetail['partner_id'])) ? $this->usersdetail['partner_id'] : $users_id);
        $trainers = $this->Users->find('list')
            ->where(['Users.user_type' => 4, 'Users.partner_id' => $trainerPartnerId]);

        $fdConditions = ['Users.user_type' => 5, 'Users.active' => '1'];
        if ($users_type == 2) {
            $fdConditions['Users.partner_id'] = $users_id;
        }
        $frontDeskUsers = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where($fdConditions)->toArray();

        $this->set(compact('users', 'name', 'status', 'norec', 'email', 'mobile', 'user_type', 'users_type', 'partners', 'partner', 'trainers', 'trainer', 'frontDeskUsers', 'front_desk_id', 'start_date', 'end_date', 'date_type', 'tabCountAll', 'tabCountActive', 'tabCountInactive', 'tabCountEnquiry', 'tabCountExpired', 'latestPlans'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->PlanSubscribers    = TableRegistry::get('PlanSubscribers');
        $this->Payments    = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $user = $this->Users->get($id, [
            'contain' => ['UserRemarks' => function ($q) {
                return $q->order(['UserRemarks.id' => 'DESC']);
            }]
        ]);

        // plans list (Hide financial payment details for Trainers - users_type == 3 & Front Desk - users_type == 5)
        $planData = [];
        if ($this->usersdetail['users_type'] != 3 && $this->usersdetail['users_type'] != 5) {
            $planSubscribers = $this->PlanSubscribers->find('all')
                ->where(['user_id' => $id])
                ->order(['id DESC'])
                ->toArray();
            if (!empty($planSubscribers)) {
                $i = 0;
                foreach ($planSubscribers as $plan) {
                    $paidAmount = $this->Payments->find('all');
                    $paidAmount =        $paidAmount->select(['sum' => $paidAmount->func()->sum('amount')])
                        ->where(['plan_subscriber_id' => $plan->id, 'Payments.is_deleted' => 0])->first();
                    $paid = 0;
                    if (!empty($paidAmount->sum)) {
                        $paid = $paidAmount->sum;
                    }
                    $remaining = $plan->fee - $paid;
                    $planData[$i]['name'] = $plan->plan_name;
                    $planData[$i]['fee'] = $plan->fee;
                    $planData[$i]['paid'] = $paid;
                    $planData[$i]['remaining'] = $remaining;
                    $planData[$i]['plan_expire_date'] = $plan->plan_expire_date;
                    $planData[$i]['payment_due_date'] = $plan->payment_due_date;
                    $i++;
                }
            }
        }

        // Fetch payment transaction history for member view
        $userPaymentsHistory = [];
        if ($this->usersdetail['users_type'] != 3) {
            $userPaymentsHistory = $this->Payments->find('all')
                ->contain(['PlanSubscribers'])
                ->where(['Payments.user_id' => $id, 'Payments.is_deleted' => 0])
                ->order(['Payments.id' => 'DESC'])
                ->toArray();
        }

        $this->set(compact('planData', 'user', 'userPaymentsHistory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        //pr($this->usersdetail);die;
        $users_type = $this->usersdetail['users_type'];
        $users_email = $this->usersdetail['users_email'];
        $users_name = $this->usersdetail['users_name'];
        $users_id   = $this->usersdetail['users_id'];
        $user       = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;

            // Check if email already belongs to an active Admin or Partner
            if (!empty($data['email'])) {
                $existingAdminPartner = $this->Users->find('all')
                    ->where([
                        'email' => trim($data['email']),
                        'user_type IN' => [1, 2],
                        'active' => '1'
                    ])->first();

                if (!empty($existingAdminPartner)) {
                    $roleLabel = ($existingAdminPartner->user_type == 1) ? __('an Admin') : __('a Partner');
                    $errorMsg = __('This email address belongs to {0} account ("{1}"). Please use a different email address.', $roleLabel, $existingAdminPartner->name);
                    $user = $this->Users->patchEntity($user, $data);
                    $user->errors('email', [$errorMsg]);
                    $this->Flash->error($errorMsg);
                    $this->set(compact('user', 'users_type'));
                    return;
                }
            }

            $t    = time();
            $name = $data['name'] . $t;
            if (isset($users_type) && ($users_type == 2 || $users_type == 5)) {
                $data['user_type'] = '3';
            }
            if ($users_type == 5) {
                $data['partner_id'] = isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : $users_id;
            } else {
                $data['partner_id'] = $users_id;
            }
            $data['added_by']   = $users_id;
            if (!empty($data['trainer_userid'])) {
                $data['trainer_userid'] = $data['trainer_userid'];
            }
            $data['username']   = $this->slugify($name);
            $data['guestid']    = $this->Cookie->read('guest_id');
            $data['verified']   = '1';
            $data['active']     = '2';
            // pr($data);exit;

            $user = $this->Users->patchEntity($user, $data);
            $user->added_by = $users_id;
            
            try {
                $useradd = $this->Users->save($user);
                if ($useradd && !empty($users_id)) {
                    $db = $this->Users->getConnection();
                    $db->execute("UPDATE users SET added_by = ? WHERE id = ?", [(int)$users_id, (int)$useradd->id]);
                }
            } catch (\Exception $e) {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
                $this->set(compact('user', 'users_type', 'trainers'));
                return;
            }

            if ($useradd) {

                $userDataArr['name']  = $data['name'];
                $userDataArr['email'] = $data['email'];
                $userDataArr['users_name'] = $users_name;
                $userDataArr['users_type'] = $users_type;
                $toEmail              = $data['email'];
                if ($users_type == 1) {
                    $subject              = 'Successfully Inquery | Datamonitoring';
                } else {
                    $subject              = 'Successfully Inquery | ' . $users_name;
                }
                $email                = new Email();
                $email->transport('default');
                try {
                    $email->emailFormat('html');
                    $email->template('inquery')
                        ->from(['support@datamonitering.com' => 'Datamonitoring'])
                        ->to($toEmail)
                        ->subject($subject)
                        ->viewVars($userDataArr)
                        ->send();
                } catch (\Exception $e) {
                }
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'payment', $useradd->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $partnerIdForTrainers = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($this->usersdetail['partner_id'])) ? $this->usersdetail['partner_id'] : null);
        $trainerConditions = ['Users.user_type' => 4, 'Users.active' => '1'];
        if (!empty($partnerIdForTrainers)) {
            $trainerConditions['Users.partner_id'] = $partnerIdForTrainers;
        }
        $trainers = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where($trainerConditions)->toArray();

        $this->set(compact('user', 'users_type', 'trainers'));
        $this->set('_serialize', ['user']);
    }

    public function payment($id = '')
    {
        $this->PlanSubscribers = TableRegistry::get('PlanSubscribers');
        $this->Payments        = TableRegistry::get('Payments');
        $planSubscribers       = $this->PlanSubscribers->newEntity();
        $payments              = $this->Payments->newEntity();
        $plandata              =   $paymentdata = [];
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_name = $this->usersdetail['users_name'];
        $users_id   = $this->usersdetail['users_id'];
        $user       = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            if (!empty($data['discount_percent']) && (float)$data['discount_percent'] > 0 && empty(trim($data['discount_reason'] ?? ''))) {
                $this->Flash->error(__('A Discount Remark / Reason is mandatory when a discount is applied.'));
                return $this->redirect(['action' => 'payment', $id]);
            }
            if (empty($data['email']) && !empty($user->email)) {
                $data['email'] = $user->email;
            }
            if (!empty($data['password'])) {
                if ($data['password'] != $data['cpassword']) {
                    $this->Flash->error(__('Password and confirm password do not match.'));
                    return $this->redirect(['action' => 'payment', $id]);
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
            if (isset($data['trainer_userid'])) {
                $user->trainer_userid = !empty($data['trainer_userid']) ? $data['trainer_userid'] : null;
            }
            $user = $this->Users->patchEntity($user, $data, ['validate' => false]);
            try {
                $useradd = $this->Users->save($user);
            } catch (\Exception $e) {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
                return $this->redirect(['action' => 'payment', $id]);
            }
            $targetPartnerId = !empty($user->partner_id) ? $user->partner_id : ($users_type == 2 ? $users_id : (isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : $users_id));
            if ($useradd) {
                // Auto-fetch plan_name and fee if plan_id is provided but plan_name was not populated by JS
                if (empty($data['plan_name']) && !empty($data['plan_id'])) {
                    $plansTbl = TableRegistry::get('Plans');
                    $planObj = $plansTbl->find()->where(['id' => $data['plan_id']])->first();
                    if ($planObj) {
                        $data['plan_name'] = $planObj->title;
                        if (empty($data['fee'])) {
                            $data['fee'] = $planObj->fee;
                        }
                    }
                }

                if (!empty($data['plan_name'])) {
                    // insert into plan_subscribers
                    $plandata['user_id']         = $user->id;
                    $plandata['partner_id']      = $targetPartnerId;
                    $plandata['collection_type'] = 'normal';
                    $plandata['plan_name']       = $data['plan_name'];
                    $plandata['fee']             = !empty($data['fee']) ? $data['fee'] : 0;
                    $plandata['currency']        = 'INR';
                    $plandata['plan_expire_date'] = !empty($data['plan_expire_date']) ? date('Y-m-d H:i:s', strtotime($data['plan_expire_date'])) : date('Y-m-d H:i:s', strtotime('+30 days'));
                    $plandata['payment_due_date'] = !empty($data['payment_due_date']) ? date('Y-m-d H:i:s', strtotime($data['payment_due_date'])) : null;
                    if (!empty($data['subscription_start_date'])) {
                        $plandata['subscription_start_date'] = date('Y-m-d', strtotime($data['subscription_start_date']));
                    }
                    if (!empty($data['reminder_date'])) {
                        $plandata['reminder_date'] = date('Y-m-d', strtotime($data['reminder_date']));
                    }
                    $planSubscribers             = $this->PlanSubscribers->patchEntity($planSubscribers, $plandata);
                    $planSubscribers->collection_type = 'normal';
                    $planSubscribersAdd = $this->PlanSubscribers->save($planSubscribers);

                    if ($planSubscribersAdd) {
                        // Direct DB update to guarantee collection_type is normal
                        $db = $this->PlanSubscribers->getConnection();
                        $db->execute("UPDATE plan_subscribers SET collection_type = 'normal' WHERE id = ?", [(int)$planSubscribersAdd->id]);
                        // insert into payments
                        $paymentdata['user_id']             = $user->id;
                        $paymentdata['partner_id']          = $targetPartnerId;
                        $paymentdata['plan_subscriber_id']  = $planSubscribersAdd->id;
                        $paymentdata['amount']              = !empty($data['amount']) ? $data['amount'] : 0;
                        $paymentdata['currency']            = 'INR';
                        $paymentdata['payment_date']        = !empty($data['payment_date']) ? $this->parsePaymentDate($data['payment_date']) : date('Y-m-d');
                        $paymentdata['discount_percent']    = !empty($data['discount_percent']) ? (float)$data['discount_percent'] : 0.00;
                        $paymentdata['discount_amount']     = !empty($data['discount_amount']) ? (float)$data['discount_amount'] : 0.00;
                        $paymentdata['discount_reason']     = !empty($data['discount_reason']) ? $data['discount_reason'] : null;

                        $payments    = $this->Payments->patchEntity($payments, $paymentdata);
                        $payments->payment_date = $paymentdata['payment_date'];
                        $payments->mode_ofpay = !empty($data['mode_ofpay']) ? $data['mode_ofpay'] : null;
                        $paymentssAdd = $this->Payments->save($payments);
                        if ($paymentssAdd && !empty($paymentdata['payment_date'])) {
                            $db = $this->Payments->getConnection();
                            $db->execute("UPDATE payments SET payment_date = ? WHERE id = ?", [$paymentdata['payment_date'], (int)$paymentssAdd->id]);
                        }

                        // Update active status for Enquiry users based on payment completion
                        if (!empty($user->active) && $user->active == 2) {
                            if ($paymentssAdd && !empty($data['amount']) && $data['amount'] > 0) {
                                $user->active = 1;
                                $this->Users->save($user);
                            } else {
                                $user->active = 2;
                                $this->Users->save($user);
                            }
                        }
                    } else {
                        $psErrors = $planSubscribers->getErrors();
                        $this->Flash->error(__('Could not save plan: ') . json_encode($psErrors));
                        return $this->redirect(['action' => 'payment', $id]);
                    }
                }
                if (!empty($data['password'])) {
                    $userDataArr['name']      = $data['name'];
                    $userDataArr['users_type'] = $users_type;
                    $userDataArr['users_name'] = $users_name;
                    $userDataArr['password']  = $data['cpassword'];
                    $userDataArr['email']     = $data['email'];
                    $userDataArr['planName']  = !empty($data['plan_name']) ? $data['plan_name'] : '';
                    $userDataArr['expireDate'] = !empty($data['plan_expire_date']) ? date('d M Y', strtotime($data['plan_expire_date'])) : '';
                    $userDataArr['totalFee']  = !empty($data['fee']) ? $data['fee'] : 0;
                    $userDataArr['paidAmount'] = !empty($data['amount']) ? $data['amount'] : 0;
                    $userDataArr['login_url'] = Router::url('/', ['controller' => 'Users', 'action' => 'login']);
                    $toEmail                  = $data['email'];
                    if ($users_type == 1) {
                        $subject              = 'Successfully Payment | Datamonitoring';
                    } else {
                        $subject              = 'Successfully Payment | ' . $users_name;
                    }
                    $email                    = new Email();
                    $email->transport('default');
                    try {
                        $email->emailFormat('html');
                        $email->template('userpass')
                            ->from(['support@datamonitering.com' => 'Datamonitoring'])
                            ->to($toEmail)
                            ->subject($subject)
                            ->viewVars($userDataArr)
                            ->send();
                    } catch (\Exception $e) {
                    }
                }
                $this->Flash->success(__('The plan has been saved successfully.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'payment', $id]);
        }
        $user_id = $id;
        $partnerIdForTrainers = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($this->usersdetail['partner_id'])) ? $this->usersdetail['partner_id'] : (!empty($user->partner_id) ? $user->partner_id : null));
        $trainerConditions = ['Users.user_type' => 4, 'Users.active' => '1'];
        if (!empty($partnerIdForTrainers)) {
            $trainerConditions['Users.partner_id'] = $partnerIdForTrainers;
        }
        $trainers = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where($trainerConditions)->toArray();
        if (empty($trainers)) {
            // Fallback to all active gym trainers
            $trainers = $this->Users->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ])->where(['Users.user_type' => 4, 'Users.active' => '1'])->toArray();
        }

        $plansTable = TableRegistry::get('Plans');
        $planConditions = ['Plans.active' => 1];
        if ($users_type != 1 && !empty($partnerIdForTrainers)) {
            $planConditions['Plans.partner_id'] = $partnerIdForTrainers;
        }
        $availablePlans = $plansTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'title'
        ])->where($planConditions)->toArray();
        if (empty($availablePlans)) {
            $availablePlans = $plansTable->find('list', [
                'keyField' => 'id',
                'valueField' => 'title'
            ])->where(['Plans.active' => 1])->toArray();
        }

        $this->set(compact('user_id', 'user', 'trainers', 'users_type', 'availablePlans'));
        $this->set('_serialize', ['user_id', 'user', 'users_type']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        if ($users_type == 5) {
            $this->Flash->error(__('Front Desk role is restricted from editing user records.'));
            return $this->redirect(['action' => 'index']);
        }
        $users_id = $this->usersdetail['users_id'];
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isAllowedToEditEmail = in_array($this->usersdetail['users_email'], $allowedEmails);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            // $data['guestid'] = '11';

            if (!$isAllowedToEditEmail) {
                unset($data['email']);
            }

            if (isset($this->request->data['images']['name']) && $data['images']['name'] != "") {
                $flname = time() . str_replace(" ", "", $data['images']['name']);
                $flpath = WWW_ROOT . "img/" . $flname;
                if (move_uploaded_file($data['images']['tmp_name'], $flpath)) {
                    $data['photo'] = $flname;
                }
            }
            //  pr($data); die;
            if (!empty($data['trainer_userid'])) {
                $user->trainer_userid = $data['trainer_userid'];
            }

            $user = $this->Users->patchEntity($user, $data);
            //   pr($user); die;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        if ($users_type == 1) {
            $trainers = $this->Users->find('list')
                ->where(['Users.user_type' => 4, 'Users.active !=' => '3']);
        } else {
            $trainerPartnerId = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($this->usersdetail['partner_id'])) ? $this->usersdetail['partner_id'] : (!empty($user->partner_id) ? $user->partner_id : $users_id));
            $trainers = $this->Users->find('list')
                ->where(['Users.user_type' => 4, 'Users.partner_id' => $trainerPartnerId, 'Users.active !=' => '3']);
        }
        $this->set(compact('user', 'users_type', 'trainers', 'users_type'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        if ($this->usersdetail['users_type'] == 5) {
            $this->Flash->error(__('Front Desk role is restricted from deleting user records.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function softDelete($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        if (!in_array($this->usersdetail['users_email'], $allowedEmails)) {
            $this->Flash->error(__('You are not authorized to perform this action.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user->active = '3';

        $timestamp = time();
        if (!empty($user->email)) {
            $user->email = $user->email . '.deleted.' . $timestamp;
        }
        if (!empty($user->username)) {
            $user->username = $user->username . '.deleted.' . $timestamp;
        }
        if (!empty($user->mobile_no)) {
            $user->mobile_no = $user->mobile_no . '.deleted.' . $timestamp;
        }

        $redirectAction = ($user->user_type == 4) ? 'trainerList' : 'index';

        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been soft-deleted.'));
        } else {
            $this->Flash->error(__('The user could not be soft-deleted. Please, try again.'));
        }

        return $this->redirect(['action' => $redirectAction]);
    }


    public function verifiedUpdate()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $this->autoRender = false;
        $get_id = $this->request->data['id'];

        $verified = $this->request->data['verified'];


        if ($verified == '1') {
            $verified_chg = '0';
        } else {
            $verified_chg = '1';
        }
        $query = $this->Users->query();
        $result = $query->update()
            ->set(['verified' => $verified_chg])
            ->where(['id' => $get_id])
            ->execute();
        $user = $this->Users->find()
            ->select(['email', 'name'])
            ->where(['id' => $get_id])
            ->first();

        if ($verified_chg == '0') {

            echo '<button id=' . $get_id . ' class="btn btn-primary waves-effect" value=' . $verified_chg . ' onclick="updateVerified(this.id,' . $verified_chg . ')" type="submit">UnApproved</button>';
        } else {




            echo '<button id=' . $get_id . ' class="btn btn-success waves-effect" value=' . $verified_chg . ' onclick="updateVerified(this.id,' . $verified_chg . ')" type="submit">Approved</button>';
        }
    }


    public function status()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        if ($users_type == 5) {
            echo '<script>alert("Front Desk role cannot change user status.");</script>';
            exit;
        }

        $id = $this->request->params['pass'][0];
        $status = $this->request->params['pass'][1];
        $user = $this->Users->get($id);

        if ($user->active == 1 || $status == 1) {
            $user_data['active'] = 0;
            $user_data['id'] = $id;
            $user = $this->Users->patchEntity($user, $user_data);
            if ($this->Users->save($user)) {
                echo '<button id=' . $id . ' class="status-badge inactive-badge waves-effect" value=' . $user_data['active'] . ' onclick="updateStatus(this.id,' . $user_data['active'] . ')" type="submit">Inactive</button>';
                exit;
            }
        } else {
            // Activating user (from Enquiry or Inactive). If Enquiry (active == 2), check payment record!
            if ($user->active == 2 || $status == 2) {
                $this->Payments = TableRegistry::get('Payments');
                $paidSum = $this->Payments->find()
                    ->select(['total' => $this->Payments->func()->sum('amount')])
                    ->where(['user_id' => $id])
                    ->first();
                if (empty($paidSum) || empty($paidSum->total) || $paidSum->total <= 0) {
                    echo '<script>Swal.fire("Payment Required", "Cannot activate Enquiry user without a valid payment record. Please add payment first.", "warning");</script><button id=' . $id . ' class="status-badge enquiry-badge waves-effect" value="2" onclick="updateStatus(this.id,2)" type="submit">Enquiry</button>';
                    exit;
                }
            }

            $user_data['active'] = 1;
            $user_data['id'] = $id;
            $user = $this->Users->patchEntity($user, $user_data);
            if ($this->Users->save($user)) {
                echo '<button id=' . $id . ' class="status-badge active-badge waves-effect" value=' . $user_data['active'] . ' onclick="updateStatus(this.id,' . $user_data['active'] . ')" type="submit">Active</button>';
                exit;
            }
        }
    }

    /*
    *Login UI function
    */
    public function adminLogin()
    {
        $this->viewBuilder()->layout("ajax");
        // Only redirect to dashboard if this is a direct login action visit,
        // not when browsing the homepage while already logged in.
        // The homepage IS the adminLogin page, so we just render it normally.
    }

    /**
     * Expired Users page with date range filter and status filters
     */
    public function expiredUsers()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];

        $name = $this->request->query('name') ?? '';
        $email = $this->request->query('email') ?? '';
        $mobile = $this->request->query('mobile') ?? '';
        $front_desk_id = $this->request->query('front_desk_id') ?? '';
        $filter_type = $this->request->query('filter_type') ?? 'all'; // all, expired, expiring_soon
        $start_date = $this->request->query('start_date') ?? '';
        $end_date = $this->request->query('end_date') ?? '';
        $norec = (int)($this->request->query('norec') ?? 20);
        if ($norec <= 0) { $norec = 20; }

        $planSubscribersTable = TableRegistry::get('PlanSubscribers');

        // Base user search conditions
        $userSearch = ['Users.active !=' => 3, 'Users.user_type !=' => 1, 'Users.user_type NOT IN' => [4, 5]];

        if (!empty($name)) {
            $userSearch['Users.name REGEXP'] = trim($name);
        }
        if (!empty($email)) {
            $userSearch['Users.email REGEXP'] = trim($email);
        }
        if (!empty($mobile)) {
            $userSearch['Users.mobile_no REGEXP'] = trim($mobile);
        }
        if (!empty($front_desk_id)) {
            $userSearch['Users.added_by'] = $front_desk_id;
        }

        if ($users_type == 2) {
            $userSearch['Users.partner_id'] = $users_id;
        } elseif ($users_type == 4) {
            $ptUserIds = TableRegistry::get('UserPtSubscriptions')->find()->select(['user_id'])->where(['trainer_id' => $users_id]);
            $userSearch['OR'] = [
                'Users.trainer_userid' => $users_id,
                'Users.id IN' => $ptUserIds
            ];
        } elseif ($users_type == 5) {
            $partnerId = isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : 0;
            $userSearch['Users.partner_id'] = $partnerId;
            $userSearch['Users.added_by'] = $users_id;
        }

        $todayStr = date('Y-m-d');

        // Fetch matching users with details
        $usersList = $this->Users->find('all')
            ->where($userSearch)
            ->contain(['AddedByUsers', 'Partners'])
            ->toArray();

        $userIds = array_map(function($u) { return $u->id; }, $usersList);

        $latestPlans = [];
        if (!empty($userIds)) {
            $allSubs = $planSubscribersTable->find('all')
                ->where(['user_id IN' => $userIds])
                ->order(['id' => 'DESC'])
                ->toArray();
            foreach ($allSubs as $sub) {
                if (!isset($latestPlans[$sub->user_id])) {
                    $latestPlans[$sub->user_id] = $sub;
                }
            }
        }

        $filteredUsers = [];
        $totalExpiredCount = 0;
        $totalExpiringSoonCount = 0;

        foreach ($usersList as $u) {
            $plan = $latestPlans[$u->id] ?? null;
            if (!$plan || empty($plan->plan_expire_date)) {
                continue;
            }

            $expDateStr = $plan->plan_expire_date->format('Y-m-d');
            $isExpired = ($expDateStr < $todayStr);
            $isExpiringSoon = ($expDateStr >= $todayStr);

            if ($isExpired) {
                $totalExpiredCount++;
            } else {
                $totalExpiringSoonCount++;
            }

            // Status Filter logic
            if ($filter_type === 'expired' && !$isExpired) {
                continue;
            }
            if ($filter_type === 'expiring_soon' && !$isExpiringSoon) {
                continue;
            }

            // Date Range Filter logic
            if (!empty($start_date) && $expDateStr < $start_date) {
                continue;
            }
            if (!empty($end_date) && $expDateStr > $end_date) {
                continue;
            }

            $u->latest_plan = $plan;
            $u->is_expired = $isExpired;
            $filteredUsers[] = $u;
        }

        // Pagination for filtered array
        $page = (int)($this->request->query('page') ?? 1);
        if ($page <= 0) { $page = 1; }
        $totalRecords = count($filteredUsers);
        $totalPages = ceil($totalRecords / $norec);
        if ($totalPages <= 0) { $totalPages = 1; }
        $offset = ($page - 1) * $norec;
        $pagedUsers = array_slice($filteredUsers, $offset, $norec);

        $fdConditions = ['Users.user_type' => 5, 'Users.active' => '1'];
        if ($users_type == 2) {
            $fdConditions['Users.partner_id'] = $users_id;
        }
        $frontDeskUsers = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where($fdConditions)->toArray();

        $this->set(compact(
            'pagedUsers', 'name', 'email', 'mobile', 'front_desk_id',
            'filter_type', 'start_date', 'end_date', 'norec', 'page',
            'totalRecords', 'totalPages', 'totalExpiredCount', 'totalExpiringSoonCount',
            'frontDeskUsers', 'users_type'
        ));
    }
    public function dashboard()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];

        $uesrs = TableRegistry::get('Users');
        $query = $uesrs->find()->select(['Users.id'])
            ->where([
                'Users.active !=' => 3,
                'Users.user_type NOT IN' => ['1', '2', '4', '5']
            ]);
        
        if (isset($users_type) && ($users_type == 2)) {
            $query->where(['Users.partner_id' => $users_id]);
        } elseif (isset($users_type) && ($users_type == 4)) {
            $ptUserIds = TableRegistry::get('UserPtSubscriptions')->find()->select(['user_id'])->where(['trainer_id' => $users_id]);
            $query->where([
                'OR' => [
                    'Users.trainer_userid' => $users_id,
                    'Users.id IN' => $ptUserIds
                ]
            ]);
        } elseif (isset($users_type) && ($users_type == 5)) {
            $partnerId = isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : 0;
            $query->where(['Users.partner_id' => $partnerId]);
        }
        
        $users_count = $query->count();

        // Initialize variables for popups
        $expiredMembers = [];
        $birthdayMembers = [];
        $isMyBirthday = false;

        $session = $this->request->session();
        if (!$session->read('DashboardAlertsShown')) {
            // 1. Expired subscriptions logic (For Admin, Partner, Trainer)
            if (in_array($users_type, ['1', '2', '4'])) {
                $psTable = TableRegistry::get('PlanSubscribers');
                $allSubsQuery = $psTable->find('all')
                    ->contain(['Users'])
                    ->where([
                        'Users.active !=' => 2,
                        'Users.user_type NOT IN' => ['1', '2', '4']
                    ]);

                if ($users_type == 2) {
                    $allSubsQuery->where(['Users.partner_id' => $users_id]);
                } elseif ($users_type == 4) {
                    $allSubsQuery->where(['Users.trainer_userid' => $users_id]);
                }

                $allSubs = $allSubsQuery->order(['PlanSubscribers.id' => 'DESC'])->toArray();

                $processedUsers = [];
                foreach ($allSubs as $sub) {
                    $uid = $sub->user_id;
                    if (in_array($uid, $processedUsers)) {
                        continue;
                    }
                    $processedUsers[] = $uid;

                    // Check if the latest subscription has expired EXACTLY TODAY (past ones ignored)
                    if ($sub->plan_expire_date && $sub->plan_expire_date->format('Y-m-d') == date('Y-m-d')) {
                        $expiredMembers[] = [
                            'user_name' => $sub->user->name,
                            'plan_name' => $sub->plan_name,
                            'expire_date' => $sub->plan_expire_date->format('d-m-Y')
                        ];
                    }
                }
            }

            // 2. Birthday greetings logic
            // For Members (user_type == 3), check if it's their own birthday today
            if ($users_type == 3) {
                $me = $uesrs->find('all')
                    ->where([
                        'Users.id' => $users_id,
                        'Users.dob IS NOT' => null,
                        'MONTH(Users.dob) =' => date('m'),
                        'DAY(Users.dob) =' => date('d')
                    ])
                    ->first();
                if ($me) {
                    $isMyBirthday = true;
                }
            }
            // For Admin (1), Partner (2), or Trainer (4) - fetch members having birthday today
            if (in_array($users_type, ['1', '2', '4'])) {
                $bquery = $uesrs->find('all')
                    ->where([
                        'Users.active !=' => 2,
                        'Users.user_type NOT IN' => ['1', '2', '4'],
                        'Users.dob IS NOT' => null,
                        'MONTH(Users.dob) =' => date('m'),
                        'DAY(Users.dob) =' => date('d')
                    ]);

                if ($users_type == 2) {
                    $bquery->where(['Users.partner_id' => $users_id]);
                } elseif ($users_type == 4) {
                    $bquery->where(['Users.trainer_userid' => $users_id]);
                }

                $birthdayMembers = $bquery->toArray();
            }

            $session->write('DashboardAlertsShown', true);
        }

        // Trainer on-dashboard specific widgets (upcoming/recent expiries & birthdays)
        $trainerUpcomingExpiries = [];
        $trainerTodayBirthdays = [];
        if ($users_type == 4) {
            $psTable = TableRegistry::get('PlanSubscribers');
            $ptUserIds = TableRegistry::get('UserPtSubscriptions')->find()->select(['user_id'])->where(['trainer_id' => $users_id]);
            
            $subs = $psTable->find('all')
                ->contain(['Users'])
                ->where([
                    'Users.active !=' => 2,
                    'OR' => [
                        'Users.trainer_userid' => $users_id,
                        'Users.id IN' => $ptUserIds
                    ],
                    'PlanSubscribers.plan_expire_date IS NOT' => null
                ])
                ->toArray();

            // Group subscriptions by user_id to pick each client's most relevant subscription
            $userSubs = [];
            foreach ($subs as $sub) {
                if (empty($sub->plan_expire_date) || empty($sub->user_id)) continue;
                $userSubs[$sub->user_id][] = $sub;
            }

            $today = date('Y-m-d');
            $expiringSoonThreshold = date('Y-m-d', strtotime('+15 days'));

            foreach ($userSubs as $uid => $uSubsList) {
                $activeOrUpcoming = [];
                $pastExpired = [];

                foreach ($uSubsList as $s) {
                    $expStr = $s->plan_expire_date->format('Y-m-d');
                    if ($expStr >= $today) {
                        $activeOrUpcoming[] = $s;
                    } else {
                        $pastExpired[] = $s;
                    }
                }

                if (!empty($activeOrUpcoming)) {
                    // Pick the active plan expiring soonest (earliest date)
                    usort($activeOrUpcoming, function($a, $b) {
                        return strcmp($a->plan_expire_date->format('Y-m-d'), $b->plan_expire_date->format('Y-m-d'));
                    });
                    $chosen = $activeOrUpcoming[0];
                } else {
                    // All plans expired, pick the one that expired most recently
                    usort($pastExpired, function($a, $b) {
                        return strcmp($b->plan_expire_date->format('Y-m-d'), $a->plan_expire_date->format('Y-m-d'));
                    });
                    $chosen = $pastExpired[0];
                }

                $rawDate = $chosen->plan_expire_date->format('Y-m-d');
                if ($rawDate < $today) {
                    $status = 'expired';
                } elseif ($rawDate <= $expiringSoonThreshold) {
                    $status = 'expiring_soon';
                } else {
                    $status = 'active';
                }

                $trainerUpcomingExpiries[] = [
                    'user_id' => $chosen->user_id,
                    'user_name' => $chosen->user ? $chosen->user->name : 'N/A',
                    'plan_name' => $chosen->plan_name,
                    'expire_date' => $chosen->plan_expire_date->format('d-m-Y'),
                    'raw_date' => $rawDate,
                    'status' => $status,
                    'is_expired' => ($status === 'expired')
                ];
            }

            // Sort: Expiring Soon (1) first by date ASC, then Active (2) by date ASC, then Expired (3) by date DESC
            usort($trainerUpcomingExpiries, function($a, $b) {
                $orderMap = ['expiring_soon' => 1, 'active' => 2, 'expired' => 3];
                $pA = $orderMap[$a['status']] ?? 2;
                $pB = $orderMap[$b['status']] ?? 2;
                if ($pA !== $pB) {
                    return $pA - $pB;
                }
                return strcmp($a['raw_date'], $b['raw_date']);
            });

            $trainerTodayBirthdays = $uesrs->find('all')
                ->where([
                    'Users.active !=' => 2,
                    'OR' => [
                        'Users.trainer_userid' => $users_id,
                        'Users.id IN' => $ptUserIds
                    ],
                    'Users.dob IS NOT' => null,
                    'MONTH(Users.dob) =' => date('m'),
                    'DAY(Users.dob) =' => date('d')
                ])
                ->order(['Users.name' => 'ASC'])
                ->toArray();
        }

        // Restrict Monthly Collections Trend (Last 6 Months):
        // Only Root Admins (full) and Partners (scoped to partner_id) have access.
        // Never show to Trainers (4) or Front Desk (5).
        $userEmail = !empty($this->usersdetail['users_email']) ? strtolower(trim($this->usersdetail['users_email'])) : '';
        $isRootAdmin = ($users_type == 1 || in_array($userEmail, ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com']));
        $isPartner = ($users_type == 2);
        $showCollectionsTrend = ($isRootAdmin || $isPartner);

        $chartLabels = [];
        $chartValues = [];

        if ($showCollectionsTrend) {
            $paymentsTable = TableRegistry::get('Payments');
            $chartConditions = [
                'Payments.is_deleted' => 0,
                'Payments.created >=' => date('Y-m-01 00:00:00', strtotime('-5 months'))
            ];
            if (!$isRootAdmin && $isPartner) {
                $chartConditions['Payments.partner_id'] = $users_id;
            }

            $rawPayments = $paymentsTable->find('all')
                ->select(['created', 'amount'])
                ->where($chartConditions)
                ->toArray();

            // Build last 6 months skeleton
            $chartMonths = [];
            for ($i = 5; $i >= 0; $i--) {
                $ym = date('Y-m', strtotime("-$i months"));
                $label = date('M Y', strtotime("-$i months"));
                $chartMonths[$ym] = [
                    'label' => $label,
                    'total' => 0
                ];
            }

            // Aggregate in PHP
            foreach ($rawPayments as $payment) {
                if ($payment->created) {
                    $ym = $payment->created->format('Y-m');
                    if (isset($chartMonths[$ym])) {
                        $chartMonths[$ym]['total'] += (float)$payment->amount;
                    }
                }
            }

            foreach ($chartMonths as $mInfo) {
                $chartLabels[] = $mInfo['label'];
                $chartValues[] = $mInfo['total'];
            }
        }

        $this->set(compact('users_count', 'expiredMembers', 'birthdayMembers', 'isMyBirthday', 'chartLabels', 'chartValues', 'showCollectionsTrend', 'trainerUpcomingExpiries', 'trainerTodayBirthdays'));
    }


    public function login()
    {

        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            //echo 'ggg';
            $data = $this->request->data;

            $data['password'] = md5($this->request->data['password']);
            $data['email'] = $this->request->data['email'];


            $count = $this->Users->find()->select(['id'])->where(['email' => $data['email'], 'password' => $data['password'], 'active' => 1])->count();
            //pr($count); die;
            if ($count >= 1) {
                $this->Cookie->write('user_email', $data['email']);
                $this->request->session()->write('Auth.User.email', $data['email']);

                $matchingUsers = $this->Users->find()
                    ->select(['id', 'user_type', 'name', 'email', 'partner_id'])
                    ->where(['email' => $data['email'], 'password' => $data['password'], 'active' => 1])
                    ->toArray();

                usort($matchingUsers, function($a, $b) {
                    $priority = [5 => 1, 2 => 2, 1 => 3, 4 => 4, 3 => 5];
                    $pA = $priority[(int)$a->user_type] ?? 99;
                    $pB = $priority[(int)$b->user_type] ?? 99;
                    if ($pA === $pB) {
                        return $b->id <=> $a->id;
                    }
                    return $pA <=> $pB;
                });
                $user_detail = $matchingUsers[0];
                $this->Cookie->write('users', ['users_id' => $user_detail->id, 'users_name' => $user_detail->name, 'users_email' => $user_detail->email, 'users_type' => $user_detail->user_type, 'partner_id' => $user_detail->partner_id]);
                $this->request->session()->write('users', ['users_id' => $user_detail->id, 'users_name' => $user_detail->name, 'users_email' => $user_detail->email, 'users_type' => $user_detail->user_type, 'partner_id' => $user_detail->partner_id]);
                return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
            } else {
                $this->Flash->error(__('This email and password not match'));
                return $this->redirect(['controller' => 'Users', 'action' => 'adminLogin']);
            }
        }
    }


    public function logout()
    {
        $this->autoRender = false;
        $this->Cookie->delete('user_email');
        $this->Cookie->delete('users');
        $this->request->session()->delete('users');
        $this->request->session()->destroy();
        $this->Auth->logout();
        return $this->redirect('/');
    }

    /*
    *forgot password page
    */
    public function forgotPassword()
    {
        $this->viewBuilder()->layout("ajax");
    }
    /*
     * forget password
     */
    public function forgetPassword()
    {
        $this->autoRender = false;
        // check email is registered with us
        //$users_type = $this->usersdetail['users_type'];
        //$users_name = $this->usersdetail['users_name'];
        $userData = $this->Users->find()
            ->select(['id', 'name', 'partner_id'])
            ->where(['email' => $this->request->data['email'], 'active !=' => '3'])
            ->order(['user_type' => 'ASC', 'id' => 'DESC']);
        $userDatas = $userData->first();
        if (!empty($userDatas)) {
            $partner = $this->Users->find()->select(['id', 'name', 'user_type'])->where(['id' => $userDatas->partner_id])->first();
            // token and url generate
            $userid = $userDatas->id;
            $useremail = $this->request->data['email'];
            $tokenString = json_encode(['id' => $userid, 'email' => $useremail, 'uid' => time()]);
            $token = $this->Common->base64url_encode($tokenString);
            $postData = $this->request->data;
            $postData['user_id'] = $userid;
            $postData['token'] = $token;
            $postData['status'] = 1;
            $insertRequest = $this->Common->createToken($postData);
            if (!empty($insertRequest)) {
                $subject = 'Reset password link';
                $verifylink = SITE_URL . 'reset-password/' . $token;
                $userDataArr['name']  = $userData->name;
                $userDataArr['link']  = $verifylink;
                $userDataArr['users_type'] = $partner->user_type;
                $userDataArr['users_name'] = $partner->name;
                // $userDataArr['users_type']= $users_type;
                //$userDataArr['users_name']= $users_name;
                $email      = new Email();
                $email->transport('default');
                try {
                    $email->emailFormat('html');
                    $email->template('forgetPassword')
                        ->from(['support@datamonitering.com' => 'Datamonitoring'])
                        ->to($useremail)
                        ->subject($subject)
                        ->viewVars($userDataArr)
                        ->send();
                } catch (\Exception $e) {
                }
                $result = ['msg_type' => 'success', 'msg' => 'Reset password link sent on your registered email.'];
            } else {
                $result = ['msg_type' => 'fail', 'msg' => 'Some error, please try again.'];
            }
        } else {
            $result = ['msg_type' => 'fail', 'msg' => 'This email is not registered with us.'];
        }

        echo json_encode($result);
        exit();
    }

    /*
     * forget password
     */
    public function resetPassword($token)
    {
        $this->viewBuilder()->layout("ajax");
        $this->Tokens    = TableRegistry::get('Tokens');
        if (!empty($token)) {
            $tokenString = $this->Common->base64url_decode($token);
            $tokenArray  = json_decode($tokenString, true);
            //step-1 check token is valid and not expired
            $tokenData    = $this->Tokens->find()->select(['token'])
                ->where(['token' => $token, 'user_id' => $tokenArray['id'], 'email' => $tokenArray['email'], 'created >=' => date('Y-m-d H:i:s', strtotime('-1 Hour'))])
                ->order(['id DESC'])->first();
            if (!empty($tokenData)) {
                //if post 
                if ($this->request->is('post')) {
                    $postData = $this->request->data;
                    // check password and confirm password are same
                    if ($postData['newpassword'] == $postData['confirmpassword'] && !empty($postData['newpassword'])) {
                        // update password in users table
                        $user = $this->Users->get($tokenArray['id']);
                        $data['password'] = md5($postData['newpassword']);
                        $user    = $this->Users->patchEntity($user, $data);
                        $useradd = $this->Users->save($user);
                        if ($useradd) {
                            // redirect to login page
                            $this->Flash->error(__('Password is updated successfully.'));
                            return $this->redirect(['controller' => 'Users', 'action' => 'adminLogin']);
                        } else {
                            $this->Flash->error(__('Some error in updating password.'));
                        }
                    } else {
                        $this->Flash->error(__('New password and comfirm password are not same.'));
                    }
                }
            } else {
                $this->Flash->error(__('Invalid/expired Url.'));
            }
        } else {
            $this->Flash->error(__('Invalid Url.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'adminLogin']);
        }

        $this->set(compact('token'));
    }

    /*
     * Add payments for user's plan
     */
    public function addPayment($userid)
    {
        $this->Payments    = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];

        $targetUser = $this->Users->find()->where(['id' => $userid])->first();
        $targetPartnerId = !empty($targetUser->partner_id) ? $targetUser->partner_id : ($users_type == 2 ? $users_id : (isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : $users_id));

        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $data = !empty($this->request->getData()) ? $this->request->getData() : $this->request->data;
            $parsedDate = $this->parsePaymentDate($data['payment_date'] ?? '');

            if (!empty($data['discount_percent']) && (float)$data['discount_percent'] > 0 && empty(trim($data['discount_reason'] ?? ''))) {
                $this->Flash->error(__('A Discount Remark / Reason is mandatory when a discount is applied.'));
                return $this->redirect(['action' => 'addPayment', $userid]);
            }
            $data['payment_date'] = $parsedDate;
            $data['partner_id'] = $targetPartnerId;
            $data['currency'] = 'INR';
            $payment = $this->Payments->patchEntity($payment, $data);
            $payment->payment_date = $parsedDate;
            $payment->mode_ofpay = $data['mode_ofpay'];
            if ($this->Payments->save($payment)) {
                if (!empty($parsedDate) && !empty($payment->id)) {
                    $db = $this->Payments->getConnection();
                    $db->execute("UPDATE payments SET payment_date = ? WHERE id = ?", [$parsedDate, (int)$payment->id]);
                }
                if (!empty($data['plan_subscriber_id'])) {
                    $PlanSubscribersTbl = TableRegistry::get('PlanSubscribers');
                    $db = $PlanSubscribersTbl->getConnection();
                    $db->execute("UPDATE plan_subscribers SET collection_type = 'normal' WHERE id = ? AND (collection_type IS NULL OR collection_type = '')", [(int)$data['plan_subscriber_id']]);
                }
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }

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
            ->where([
                'user_id' => $userid,
                'OR' => [
                    'PlanSubscribers.collection_type !=' => 'manual',
                    'PlanSubscribers.collection_type IS' => null
                ]
            ]);
        $this->set(compact('payment', 'users', 'partners', 'planSubscribers', 'userid'));
    }

    /*
     * show plan list select inout using ajax
     */
    public function showPlanList($userid)
    {
        $this->viewBuilder()->layout("ajax");
        $this->Payments    = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $planSubscribers = $this->Payments->PlanSubscribers->find('list', ['limit' => 200])
            ->where([
                'user_id' => $userid,
                'OR' => [
                    'PlanSubscribers.collection_type !=' => 'manual',
                    'PlanSubscribers.collection_type IS' => null
                ]
            ]);
        $this->set(compact('planSubscribers', 'userid'));
    }

    /*
     * show plan list select inout using ajax
     */
    public function showPlanDetails($planid)
    {
        $this->viewBuilder()->layout("ajax");
        $this->Payments    = TableRegistry::get('Payments');
        $this->PlanSubscribers    = TableRegistry::get('PlanSubscribers');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $planSubscribers = $this->PlanSubscribers->find('all')
            ->select(['id', 'fee', 'payment_due_date', 'plan_expire_date'])
            ->where(['id' => $planid])->first();
        $paidAmount = $this->Payments->find('all');
        $paidAmount = $paidAmount->select(['sum' => $paidAmount->func()->sum('amount')])
            ->where(['plan_subscriber_id' => $planSubscribers->id, 'Payments.is_deleted' => 0])->first();
        $paid = 0;
        if (!empty($paidAmount->sum)) {
            $paid = (float)$paidAmount->sum;
        }

        $discountAmount = $this->Payments->find('all');
        $discountAmount = $discountAmount->select(['sum' => $discountAmount->func()->sum('discount_amount')])
            ->where(['plan_subscriber_id' => $planSubscribers->id, 'Payments.is_deleted' => 0])->first();
        $discount = 0;
        if (!empty($discountAmount->sum)) {
            $discount = (float)$discountAmount->sum;
        }

        $remaining = max(0, $planSubscribers->fee - $discount - $paid);
        if (!empty($this->request->query('amount'))) {
            $updateLimit = $remaining + $this->request->query('amount');
            $paid = $paid - $this->request->query('amount');
            $remaining = $remaining + $this->request->query('amount');
        }
        $formattedFee = number_format((float)$planSubscribers->fee, 2);
        $formattedDiscount = number_format((float)$discount, 2);
        $formattedPaid = number_format((float)$paid, 2);
        $formattedRem = number_format((float)$remaining, 2);
        $dueDate = !empty($planSubscribers->payment_due_date) ? date('d M Y', strtotime($planSubscribers->payment_due_date)) : 'N/A';
        $expireDate = !empty($planSubscribers->plan_expire_date) ? date('d M Y', strtotime($planSubscribers->plan_expire_date)) : 'N/A';

        $statusBadge = ($remaining <= 0)
            ? '<span class="psc-badge paid"><i class="material-icons" style="font-size:13px; vertical-align:middle;">check_circle</i> Fully Paid</span>'
            : '<span class="psc-badge pending"><i class="material-icons" style="font-size:13px; vertical-align:middle;">schedule</i> Pending: INR ' . $formattedRem . '</span>';

        echo '<div class="plan-summary-card">';
        echo '  <div class="psc-top">';
        echo '    <div class="psc-title">';
        echo '      <i class="material-icons" style="color:#ff9800; font-size:18px;">card_membership</i>';
        echo '      <span>Selected Plan Details</span>';
        echo '    </div>';
        echo '    <div>' . $statusBadge . '</div>';
        echo '  </div>';
        echo '  <div class="psc-grid">';
        echo '    <div class="psc-item">';
        echo '      <span class="psc-label">Total Plan Fee</span>';
        echo '      <span class="psc-val">INR ' . $formattedFee . '</span>';
        echo '    </div>';
        if ($discount > 0) {
            echo '    <div class="psc-item">';
            echo '      <span class="psc-label">Discount Applied</span>';
            echo '      <span class="psc-val text-info" style="color:#0284c7; font-weight:700;">- INR ' . $formattedDiscount . '</span>';
            echo '    </div>';
        }
        echo '    <div class="psc-item">';
        echo '      <span class="psc-label">Paid So Far</span>';
        echo '      <span class="psc-val text-success" style="color:#16a34a; font-weight:700;">INR ' . $formattedPaid . '</span>';
        echo '    </div>';
        echo '    <div class="psc-item">';
        echo '      <span class="psc-label">Remaining Balance</span>';
        echo '      <span class="psc-val ' . ($remaining > 0 ? 'text-warning' : 'text-muted') . '" style="' . ($remaining > 0 ? 'color:#ea580c;' : 'color:#94a3b8;') . ' font-weight:700;">INR ' . $formattedRem . '</span>';
        echo '    </div>';
        echo '    <div class="psc-item">';
        echo '      <span class="psc-label">Payment Due Date</span>';
        echo '      <span class="psc-val date" style="display:inline-flex; align-items:center; gap:4px;"><i class="material-icons" style="font-size:15px; color:#94a3b8;">event</i> ' . $dueDate . '</span>';
        echo '    </div>';
        echo '    <div class="psc-item">';
        echo '      <span class="psc-label">Plan Expire Date</span>';
        echo '      <span class="psc-val date" style="display:inline-flex; align-items:center; gap:4px;"><i class="material-icons" style="font-size:15px; color:#94a3b8;">event_busy</i> ' . $expireDate . '</span>';
        echo '    </div>';
        echo '  </div>';
        echo '  <input type="hidden" id="fee" name="fee" value="' . $remaining . '">';
        echo '  <input type="hidden" id="total_fee" value="' . $planSubscribers->fee . '">';
        echo '  <input type="hidden" id="discount_amount" value="' . $discount . '">';
        echo '  <input type="hidden" id="paid_amount" value="' . $paid . '">';
        echo '</div>';
        exit;
    }

    /**
     * trainerList method
     *
     * @return \Cake\Http\Response|void
     */
    public function trainerList()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $name = '';
        $email = '';
        $norec = 10;
        $status = '';
        $user_type = '';
        $partner   = '';
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];

        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Users.name REGEXP'] = $name;
        }

        if (isset($this->request->query['email']) && trim($this->request->query['email']) != "") {
            $email = $this->request->query['email'];
            $search['Users.email REGEXP'] = $email;
        }

        if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['Users.active'] = $status;
        }

        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['Users.partner_id'] = $partner;
        }

        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        $search['Users.user_type'] = 4;  //triner condition
        if (isset($search)) {

            $count = $this->Users->find('all')
                ->where([$search]);
        } else {
            $count = $this->Users->find('all');
        }

        $count = $count->where(['Users.active !=' => '3', 'Users.user_type !=' => '1']);

        $partners =  $this->Users->find('list')
            ->select(['id', 'name'])
            ->where(['user_type' => 2])
            ->toArray();

        $this->paginate = ['limit' => $norec, 'order' => ['Users.id' => 'DESC']];

        $users = $this->paginate($count)->toArray();

        $this->set(compact('users', 'name', 'status', 'norec', 'email', 'user_type', 'users_type', 'partners', 'partner'));
        $this->set('_serialize', ['users']);
    }

    /**
     * trainerAdd method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function trainerAdd()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_email = $this->usersdetail['users_email'];
        $users_name = $this->usersdetail['users_name'];
        $users_id   = $this->usersdetail['users_id'];
        $user       = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $t    = time();
            $name = $data['name'] . $t;
            $data['partner_id'] = $users_id;
            $data['username']   = $this->slugify($name);
            $data['password']   = md5($this->request->data['password']);
            $data['guestid']    = $this->Cookie->read('guest_id');
            $data['user_type']   = '4';
            $data['verified']   = '1';
            $user = $this->Users->patchEntity($user, $data);
            $useradd = $this->Users->save($user);
            if ($useradd) {
                $userDataArr['name']  = $data['name'];
                $userDataArr['email'] = $data['email'];
                $userDataArr['users_name'] = $users_name;
                $userDataArr['users_type'] = $users_type;
                $toEmail              = $data['email'];
                $this->Flash->success(__('The trainer is added successfully.'));

                return $this->redirect(['action' => 'trainerList']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'users_type'));
        $this->set('_serialize', ['user']);
    }

    /**
     * trainerEdit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function trainerEdit($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The trainer is updated successfully.'));

                return $this->redirect(['action' => 'trainerList']);
            }
            $this->Flash->error(__('The trainer could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'users_type'));
        $this->set('_serialize', ['user']);
    }

    /**
     * trainerView method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function trainerView($id = null)
    {
        $this->PlanSubscribers    = TableRegistry::get('PlanSubscribers');
        $this->Payments    = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set(compact('user'));
    }


    public function siteMap()
    {
        $this->viewBuilder()->layout('sitemap');
        $this->RequestHandler->respondAs('xml');
    }

    public function saveRemark()
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post']);

        $this->UserRemarks = TableRegistry::get('UserRemarks');
        $remarkEntity = $this->UserRemarks->newEntity();

        $data = $this->request->data;
        if (!empty($data['followup_date'])) {
            $data['followup_date'] = date('Y-m-d H:i:s', strtotime($data['followup_date']));
        }
        if (!empty($this->usersdetail['users_id'])) {
            $data['created_by'] = $this->usersdetail['users_id'];
        }

        $remarkEntity = $this->UserRemarks->patchEntity($remarkEntity, $data);
        if ($this->UserRemarks->save($remarkEntity)) {
            $response = ['status' => 'success', 'message' => __('Remark saved successfully.')];
        } else {
            $errors = $remarkEntity->errors();
            $response = ['status' => 'error', 'message' => __('Could not save remark.'), 'errors' => $errors];
        }

        echo json_encode($response);
        exit;
    }

    public function getRemarks($userId)
    {
        $this->autoRender = false;
        $this->UserRemarks = TableRegistry::get('UserRemarks');

        $remarks = $this->UserRemarks->find('all')
            ->where(['user_id' => $userId])
            ->order(['created' => 'DESC'])
            ->toArray();

        $formatted = [];
        foreach ($remarks as $remark) {
            $formatted[] = [
                'remark' => h($remark->remark),
                'followup_date' => $remark->followup_date ? $remark->followup_date->format('Y-m-d H:i:s') : 'N/A',
                'created' => $remark->created ? $remark->created->format('Y-m-d H:i:s') : 'N/A'
            ];
        }

        echo json_encode($formatted);
        exit;
    }

    public function composerUpdate()
    {
        if (empty($this->usersdetail['users_type']) || $this->usersdetail['users_type'] != 1) {
            throw new \Cake\Network\Exception\ForbiddenException(__('You are not authorized to access this section.'));
        }

        $this->autoRender = false;
        
        // Disable output buffering to stream results in real-time
        if (ob_get_level()) {
            ob_end_clean();
        }
        ob_implicit_flush(true);
        
        header('Content-Type: text/plain; charset=utf-8');
        header('X-Content-Type-Options: nosniff');

        // Set high limits
        set_time_limit(900); // 15 minutes
        ini_set('memory_limit', '1024M');

        $rootDir = ROOT; // CakePHP constant for application root directory
        chdir($rootDir);

        // Set Composer environment variables (required for web-server user context)
        $composerHome = $rootDir . DS . 'tmp' . DS . '.composer';
        if (!is_dir($composerHome)) {
            @mkdir($composerHome, 0777, true);
        }
        putenv("HOME=" . $rootDir . DS . 'tmp');
        putenv("COMPOSER_HOME=" . $composerHome);

        $envVars = array_merge($_SERVER, [
            'HOME' => $rootDir . DS . 'tmp',
            'COMPOSER_HOME' => $composerHome,
        ]);

        echo "Starting secure composer update on live environment...\n";
        echo "Logged in as Admin: " . $this->usersdetail['users_name'] . "\n";
        echo "Working directory: " . getcwd() . "\n";
        echo "PHP Version: " . PHP_VERSION . "\n";
        echo "PHP Binary: " . (defined('PHP_BINARY') ? PHP_BINARY : 'php') . "\n";

        // Helper function to execute and stream command output
        $runCommand = function($cmd) use ($envVars) {
            echo "\nExecuting: $cmd\n";
            echo str_repeat('-', 80) . "\n";
            
            $descriptorSpec = [
                0 => ["pipe", "r"], // stdin
                1 => ["pipe", "w"], // stdout
                2 => ["pipe", "w"]  // stderr
            ];
            
            $process = proc_open($cmd, $descriptorSpec, $pipes, null, $envVars);
            
            if (is_resource($process)) {
                fclose($pipes[0]); // Don't need stdin
                
                // Read stdout and stderr in real-time
                while (!feof($pipes[1]) || !feof($pipes[2])) {
                    $out = fgets($pipes[1]);
                    if ($out !== false) {
                        echo $out;
                        flush();
                    }
                    $err = fgets($pipes[2]);
                    if ($err !== false) {
                        echo "ERR: " . $err;
                        flush();
                    }
                }
                
                fclose($pipes[1]);
                fclose($pipes[2]);
                
                $returnValue = proc_close($process);
                echo str_repeat('-', 80) . "\n";
                echo "Command returned: $returnValue\n";
                return $returnValue === 0;
            } else {
                echo "Failed to start process.\n";
                return false;
            }
        };

        // 1. Check if shell execution is available
        if (!function_exists('proc_open')) {
            die("Error: proc_open() function is disabled in php.ini. Cannot run shell commands.\n");
        }

        // 2. Determine PHP command name
        $phpPath = defined('PHP_BINARY') && PHP_BINARY ? PHP_BINARY : 'php';
        // Convert lsphp SAPI path to CLI php path if applicable
        if (strpos($phpPath, 'lsphp') !== false) {
            $cliPath = str_replace('lsphp', 'php', $phpPath);
            if (@file_exists($cliPath) || @is_executable($cliPath)) {
                $phpPath = $cliPath;
            }
        }

        // 3. Test if global composer is available
        echo "Checking if global composer is available...\n";
        $hasGlobalComposer = false;
        $descriptorSpec = [1 => ["pipe", "w"], 2 => ["pipe", "w"]];
        $process = proc_open("composer --version", $descriptorSpec, $pipes, null, $envVars);
        if (is_resource($process)) {
            $out = stream_get_contents($pipes[1]);
            $err = stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            $code = proc_close($process);
            if ($code === 0) {
                $hasGlobalComposer = true;
                echo "Found global composer: " . trim($out) . "\n";
            }
        }

        $composerCmd = 'composer';

        if (!$hasGlobalComposer) {
            echo "Global composer not found. Checking for composer.phar in root...\n";
            if (!file_exists('composer.phar')) {
                echo "Downloading composer.phar...\n";
                $installerUrl = 'https://getcomposer.org/installer';
                $installerCode = file_get_contents($installerUrl);
                if ($installerCode === false) {
                    die("Error: Failed to fetch composer installer from $installerUrl\n");
                }
                file_put_contents('composer-setup.php', $installerCode);
                
                echo "Running composer setup...\n";
                $setupSuccess = $runCommand("\"$phpPath\" -d register_argc_argv=Off composer-setup.php");
                unlink('composer-setup.php');
                
                if (!$setupSuccess || !file_exists('composer.phar')) {
                    die("Error: Failed to download composer.phar\n");
                }
                echo "composer.phar downloaded successfully!\n";
            } else {
                echo "Found existing composer.phar in root.\n";
            }
            
            // Create wrapper script to manually define argv and argc for Symfony console
            $wrapperFile = $rootDir . DS . 'run_composer.php';
            $wrapperCode = '<?php
$_SERVER[\'argv\'] = [\'composer.phar\', \'update\', \'--no-interaction\', \'--optimize-autoloader\'];
$_SERVER[\'argc\'] = count($_SERVER[\'argv\']);
$argv = $_SERVER[\'argv\'];
$argc = $_SERVER[\'argc\'];
require \'composer.phar\';';
            
            file_put_contents($wrapperFile, $wrapperCode);
            $composerCmd = "\"$phpPath\" -d register_argc_argv=Off run_composer.php";
        }

        // 4. Run composer update
        if ($composerCmd === 'composer') {
            $command = $composerCmd . " update --no-interaction --optimize-autoloader";
        } else {
            $command = $composerCmd;
        }
        
        echo "Starting composer update...\n";
        $success = $runCommand($command);

        // Clean up wrapper script
        if (isset($wrapperFile) && file_exists($wrapperFile)) {
            @unlink($wrapperFile);
        }

        if ($success) {
            echo "\nComposer update completed successfully!\n";
        } else {
            echo "\nComposer update failed.\n";
        }
        
        exit();
    }

    public function getTodayFollowups()
    {
        $this->autoRender = false;
        $this->request->allowMethod(['get']);

        if (empty($this->usersdetail['users_id'])) {
            $this->response->statusCode(403);
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            exit;
        }

        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];

        $partnerCondition = [];
        if ($users_type == 2) {
            $partnerCondition['Users.partner_id'] = $users_id;
        } elseif ($users_type == 4) {
            $partnerId = isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : 0;
            $partnerCondition['Users.partner_id'] = $partnerId;
        }

        $userRemarksTable = TableRegistry::get('UserRemarks');
        $usersTable = TableRegistry::get('Users');

        $today = date('Y-m-d');

        // 1. Taken Today (Followup recorded/completed today)
        $takenQuery = $userRemarksTable->find('all')
            ->contain(['Users'])
            ->where([
                'DATE(UserRemarks.created) =' => $today,
                'Users.active !=' => 3
            ]);
        if (!empty($partnerCondition)) {
            $takenQuery->where($partnerCondition);
        }
        $takenRemarks = $takenQuery->order(['UserRemarks.created' => 'DESC'])->toArray();

        // 2. Scheduled Today (Followup date is scheduled for today)
        $scheduledQuery = $userRemarksTable->find('all')
            ->contain(['Users'])
            ->where([
                'DATE(UserRemarks.followup_date) =' => $today,
                'Users.active !=' => 3
            ]);
        if (!empty($partnerCondition)) {
            $scheduledQuery->where($partnerCondition);
        }
        $scheduledRemarks = $scheduledQuery->order(['UserRemarks.followup_date' => 'ASC', 'UserRemarks.id' => 'DESC'])->toArray();

        // Gather all staff user IDs
        $staffIds = [];
        foreach (array_merge($takenRemarks, $scheduledRemarks) as $remark) {
            if ($remark->created_by) {
                $staffIds[] = $remark->created_by;
            }
            if ($remark->user && $remark->user->trainer_userid) {
                $staffIds[] = $remark->user->trainer_userid;
            }
        }

        $staffNames = [];
        if (!empty($staffIds)) {
            $staffs = $usersTable->find('all')
                ->select(['id', 'name'])
                ->where(['id IN' => array_unique($staffIds)])
                ->toArray();
            foreach ($staffs as $s) {
                $staffNames[$s->id] = $s->name;
            }
        }

        $formatRemarks = function ($remarksList) use ($staffNames) {
            $formatted = [];
            foreach ($remarksList as $remark) {
                $cust = $remark->user;
                if (!$cust) continue;

                $statusText = 'Inactive';
                if ($cust->active == 1) {
                    $statusText = 'Active';
                } elseif ($cust->active == 2) {
                    $statusText = 'Enquiry';
                }

                $staffName = 'Not Assigned';
                if (!empty($remark->created_by) && isset($staffNames[$remark->created_by])) {
                    $staffName = $staffNames[$remark->created_by];
                } elseif (!empty($cust->trainer_userid) && isset($staffNames[$cust->trainer_userid])) {
                    $staffName = $staffNames[$cust->trainer_userid];
                }

                $scheduledDateStr = 'N/A';
                $nextFollowupDateStr = null;
                if ($remark->followup_date) {
                    if ($remark->followup_date->format('H:i:s') !== '00:00:00') {
                        $scheduledDateStr = $remark->followup_date->format('d M Y • h:i A');
                        $nextFollowupDateStr = $remark->followup_date->format('d M Y • h:i A');
                    } else {
                        $scheduledDateStr = $remark->followup_date->format('d M Y');
                        $nextFollowupDateStr = $remark->followup_date->format('d M Y');
                    }
                }

                $formatted[] = [
                    'customer_name' => h(ucfirst($cust->name)),
                    'mobile_no' => h($cust->mobile_no),
                    'email' => !empty($cust->email) ? h($cust->email) : null,
                    'staff_name' => h(ucfirst($staffName)),
                    'followup_date' => $remark->created ? $remark->created->format('d M Y • h:i A') : 'N/A',
                    'scheduled_date' => $scheduledDateStr,
                    'status' => $statusText,
                    'remark' => h($remark->remark),
                    'next_followup_date' => $nextFollowupDateStr
                ];
            }
            return $formatted;
        };

        $takenFormatted = $formatRemarks($takenRemarks);
        $scheduledFormatted = $formatRemarks($scheduledRemarks);

        echo json_encode([
            'status' => 'success',
            'taken_today' => $takenFormatted,
            'scheduled_today' => $scheduledFormatted,
            'data' => $takenFormatted
        ]);
        exit;
    }

    public function exportContacts()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        if ($this->usersdetail['users_type'] == 5) {
            $this->Flash->error(__('Front Desk role is restricted from exporting client contacts.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->autoRender = false;
        
        $conditions = [
            'Users.user_type' => 3,
            'Users.active !=' => 3
        ];
        
        // Filter by partner_id if the logged-in user is type 2 (partner)
        if ($this->usersdetail['users_type'] == 2) {
            $conditions['Users.partner_id'] = $this->usersdetail['users_id'];
        }

        $clients = $this->Users->find('all')
            ->select(['name', 'mobile_no', 'email'])
            ->where($conditions)
            ->order(['Users.name' => 'ASC'])
            ->toArray();

        // Send headers for CSV download
        $filename = 'contacts_export_' . date('Ymd_His') . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Add UTF-8 BOM for proper rendering in MS Excel
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // CSV Header
        fputcsv($output, ['Name', 'Mobile', 'Email']);
        
        // CSV Data
        foreach ($clients as $client) {
            fputcsv($output, [
                $client->name,
                $client->mobile_no,
                $client->email
            ]);
        }
        
        fclose($output);
        exit;
    }

    /**
     * Clear all CakePHP caches (Models, Schema, Persistent, Core)
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
        echo "</div>";
        exit();
    }

    /**
     * frontDeskList method
     */
    public function frontDeskList()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];

        if ($users_type != 1 && $users_type != 2) {
            $this->Flash->error(__('Access Denied. Only Partners and Admins can access the Front Desk module.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
        }

        $name     = '';
        $email    = '';
        $mobile   = '';
        $norec    = 10;
        $status   = '';
        $partner  = '';
        $search   = [];

        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Users.name REGEXP'] = $name;
        }

        if (isset($this->request->query['email']) && trim($this->request->query['email']) != "") {
            $email = $this->request->query['email'];
            $search['Users.email REGEXP'] = $email;
        }

        if (isset($this->request->query['mobile']) && trim($this->request->query['mobile']) != "") {
            $mobile = $this->request->query['mobile'];
            $search['Users.mobile_no REGEXP'] = $mobile;
        }

        if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['Users.active'] = $status;
        }

        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }

        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['Users.partner_id'] = $partner;
        }

        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }

        $search['Users.user_type'] = 5; // Front Desk condition

        $count = $this->Users->find('all')
            ->where([$search])
            ->where(['Users.active !=' => '3']);

        $partners = $this->Users->find('list')
            ->select(['id', 'name'])
            ->where(['user_type' => 2, 'active !=' => '3'])
            ->toArray();

        $this->paginate = ['limit' => $norec, 'order' => ['Users.id' => 'DESC']];
        $users = $this->paginate($count)->toArray();

        $this->set(compact('users', 'name', 'status', 'norec', 'email', 'mobile', 'users_type', 'partners', 'partner'));
        $this->set('_serialize', ['users']);
    }

    /**
     * frontDeskAdd method
     */
    public function frontDeskAdd()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_name = $this->usersdetail['users_name'];
        $users_id   = $this->usersdetail['users_id'];

        if ($users_type != 1 && $users_type != 2) {
            $this->Flash->error(__('Access Denied. Only Partners and Admins can access the Front Desk module.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
        }

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $t    = time();
            $name = $data['name'] . $t;

            if ($users_type == 2) {
                $data['partner_id'] = $users_id;
            } elseif ($users_type == 1) {
                if (empty($data['partner_id'])) {
                    $this->Flash->error(__('Please select a partner for this Front Desk user.'));
                    $partners = $this->Users->find('list')->select(['id', 'name'])->where(['user_type' => 2, 'active !=' => '3'])->toArray();
                    $this->set(compact('user', 'users_type', 'partners'));
                    return;
                }
            }

            $data['username']  = $this->slugify($name);
            $data['password']  = md5($this->request->data['password']);
            $data['guestid']   = $this->Cookie->read('guest_id');
            $data['user_type'] = '5'; // Front Desk
            $data['verified']  = '1';
            $data['active']    = isset($data['active']) ? $data['active'] : '1';

            $user = $this->Users->patchEntity($user, $data);
            $useradd = $this->Users->save($user);

            if ($useradd) {
                $this->Flash->success(__('The Front Desk user has been added successfully.'));
                return $this->redirect(['action' => 'frontDeskList']);
            }
            $this->Flash->error(__('The Front Desk user could not be saved. Please, try again.'));
        }

        $partners = [];
        if ($users_type == 1) {
            $partners = $this->Users->find('list')
                ->select(['id', 'name'])
                ->where(['user_type' => 2, 'active !=' => '3'])
                ->toArray();
        }

        $this->set(compact('user', 'users_type', 'partners'));
        $this->set('_serialize', ['user']);
    }

    /**
     * frontDeskEdit method
     */
    public function frontDeskEdit($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];

        if ($users_type != 1 && $users_type != 2) {
            $this->Flash->error(__('Access Denied. Only Partners and Admins can access the Front Desk module.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
        }

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($users_type == 2 && $user->partner_id != $users_id) {
            $this->Flash->error(__('You are not authorized to edit this Front Desk user.'));
            return $this->redirect(['action' => 'frontDeskList']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            if (!empty($data['password'])) {
                $data['password'] = md5($data['password']);
            } else {
                unset($data['password']);
            }

            if ($users_type == 2) {
                $data['partner_id'] = $users_id;
            }

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The Front Desk user has been updated successfully.'));
                return $this->redirect(['action' => 'frontDeskList']);
            }
            $this->Flash->error(__('The Front Desk user could not be saved. Please, try again.'));
        }

        $partners = [];
        if ($users_type == 1) {
            $partners = $this->Users->find('list')
                ->select(['id', 'name'])
                ->where(['user_type' => 2, 'active !=' => '3'])
                ->toArray();
        }

        $this->set(compact('user', 'users_type', 'partners'));
        $this->set('_serialize', ['user']);
    }

    /**
     * frontDeskView method
     */
    public function frontDeskView($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];

        if ($users_type != 1 && $users_type != 2) {
            $this->Flash->error(__('Access Denied. Only Partners and Admins can access the Front Desk module.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
        }

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($users_type == 2 && $user->partner_id != $users_id) {
            $this->Flash->error(__('You are not authorized to view this Front Desk user.'));
            return $this->redirect(['action' => 'frontDeskList']);
        }

        $this->set(compact('user', 'users_type'));
        $this->set('_serialize', ['user']);
    }

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
