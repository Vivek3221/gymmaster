<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends AppController
{
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        if (!empty($this->usersdetail['users_type'])) {
            $userType = $this->usersdetail['users_type'];
            $action = $this->request->getParam('action');
            // Block Trainers completely from Payments
            if ($userType == 3) {
                $this->Flash->error(__('Access Denied. Trainers are not allowed to view or manage payments.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
            }
            // Block Front Desk (user_type == 5) completely from Payments
            if ($userType == 5) {
                $this->Flash->error(__('Access Denied. Front Desk role is restricted from Payments module.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
            }
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $this->Users    = TableRegistry::get('Users');
        $name = '';
        $mode_ofpay = '';
        $norec = 10;
        $status = '';
        $user_type = '';
        $partner   ='';
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        $startDate = date('01/01/Y');
        $endDate = date('d/m/Y');
        
        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        $search['Payments.is_deleted'] = 0;

        // Exclude manual collection payments from regular payments list
        $search[] = function ($exp, $q) {
            return $exp->or_([
                'PlanSubscribers.collection_type !=' => 'manual',
                'PlanSubscribers.collection_type IS' => null
            ]);
        };

        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = str_replace(',','',$this->request->query['name']);
            $search['OR'] = ['Payments.amount'=>$name,'Users.name REGEXP'=>$name,'PlanSubscribers.plan_name REGEXP'=>$name];
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        if (isset($this->request->query['mode_ofpay']) && trim($this->request->query['mode_ofpay']) != "") {
            $mode_ofpay = $this->request->query['mode_ofpay'];
            $search['Payments.mode_ofpay'] = $mode_ofpay;
        }
        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['Payments.partner_id'] = $partner;
        }
        if (isset($this->request->query['created']) && trim($this->request->query['created']) != "") {
            $created = $this->request->query['created'];
            $dateArray = explode(' - ', $created);
            if (count($dateArray) == 2) {
                $startDate = $dateArray[0];
                $endDate = $dateArray[1];
                $startDateArray = explode('/', $startDate);
                $endDateArray = explode('/', $endDate);
                if (count($startDateArray) == 3 && count($endDateArray) == 3) {
                    $startDate_u = $startDateArray[2] . '-' . $startDateArray[1] . '-' . $startDateArray[0];
                    $endDate_u = $endDateArray[2] . '-' . $endDateArray[1] . '-' . $endDateArray[0];
                    $search[] = function ($exp, $q) use ($startDate_u, $endDate_u) {
                        return $exp->and_([
                            'COALESCE(Payments.payment_date, DATE(Payments.created)) >=' => $startDate_u,
                            'COALESCE(Payments.payment_date, DATE(Payments.created)) <=' => $endDate_u
                        ]);
                    };
                }
            }
        }
        if (!empty($search)) {
            $this->Amount = $this->Payments->find()
                    ->contain(['Users','PlanSubscribers'])
                    ->select(['total_amount' => 'SUM(amount)'])->where([$search]);
            $this->Payments = $this->Payments->find('all')
                    ->contain(['Users', 'PlanSubscribers'])
                    ->where([$search]);
        } else {
            $this->Amount = $this->Payments->find()->contain(['Users','PlanSubscribers'])->select(['total_amount' => 'SUM(amount)'])->where(['Payments.is_deleted' => 0]);
            $this->Payments = $this->Payments->find('all')->contain(['Users', 'PlanSubscribers'])->where(['Payments.is_deleted' => 0]);
        }
        $total_amount = $this->Amount->where(['Users.active !=' => '3','Users.user_type !='=>'1'])->first();
        $amount = $total_amount->total_amount;
        $this->Payments = $this->Payments->where(['Users.active !=' => '3','Users.user_type !='=>'1']);
        $partners =  $this->Users->find('list')
                                 ->select(['id','name'])
                                ->where(['user_type'=> 2])
                                ->toArray();
        $this->paginate = [
            'limit' => $norec,
            'contain' => ['Users', 'Partners', 'PlanSubscribers'],
            'order' => ['id' => 'DESC']
        ];
        $payments = $this->paginate($this->Payments);

        $canDeletePayment = $this->canDeletePayment();
        $isDeleteRoot = $this->isPaymentDeleteRoot();

        $this->set(compact('payments','users', 'name', 'status', 'norec','mode_ofpay','user_type',
                'users_type','partners','partner','amount','startDate','endDate', 'canDeletePayment', 'isDeleteRoot'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->layout('ajax');
        $this->Users    = TableRegistry::get('Users');
        $payment = $this->Payments->get($id, [
            'contain' => ['Users','PlanSubscribers']
        ]);
        $partnerDetails = $this->Users->find('all')->where(['id'=>$payment->partner_id])->first();
        $this->set(compact('payment','partnerDetails'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Validate discount
            $discountPercent = (float)($data['discount_percent'] ?? 0);
            if ($discountPercent > 0 && empty(trim($data['discount_reason'] ?? ''))) {
                $this->Flash->error(__('A Discount Remark / Reason is mandatory when a discount is applied.'));
            } else {
                $data['payment_date'] = $this->parsePaymentDate($data['payment_date'] ?? '');
                
                $payment = $this->Payments->patchEntity($payment, $data);
                if ($this->Payments->save($payment)) {
                    $this->Flash->success(__('The payment has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }
        $users = $this->Payments->Users->find('list', ['limit' => 200]);
        $partners = $this->Payments->Partners->find('list', ['limit' => 200]);
        $planSubscribers = $this->Payments->PlanSubscribers->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'users', 'partners', 'planSubscribers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        if ($this->usersdetail['users_type'] == 5) {
            $this->Flash->error(__('Front Desk role is restricted from editing payment records.'));
            return $this->redirect(['action' => 'index']);
        }
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        $payment = $this->Payments->get($id, [
            'contain' => ['PlanSubscribers']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            $discountPercent = (float)($data['discount_percent'] ?? 0);
            if ($discountPercent > 0 && empty(trim($data['discount_reason'] ?? ''))) {
                $this->Flash->error(__('A Discount Remark / Reason is mandatory when a discount is applied.'));
            } else {
                $data['payment_date'] = $this->parsePaymentDate($data['payment_date'] ?? '');

                // If plan is changed and recalculate is requested
                if (!empty($data['recalculate_amount']) && !empty($data['plan_subscriber_id'])) {
                    $planSubTable = TableRegistry::get('PlanSubscribers');
                    $selectedPlanSub = $planSubTable->find()->where(['id' => $data['plan_subscriber_id']])->first();
                    if ($selectedPlanSub) {
                        $fee = (float)$selectedPlanSub->fee;
                        $discAmt = round(($fee * $discountPercent) / 100, 2);
                        $data['discount_amount'] = $discAmt;
                        $data['amount'] = max(0, $fee - $discAmt);
                    }
                }

                $payment = $this->Payments->patchEntity($payment, $data);
                $payment->mode_ofpay = $data['mode_ofpay'];
                if ($this->Payments->save($payment)) {
                    $this->Flash->success(__('The payment has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }
        
        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        $search['Users.user_type'] = 3;
        if (!empty($search)) {
            $users = $this->Payments->Users->find(['list','contain' => ['Users', 'Partners']])
                    ->where([$search]);
        } else {
            $users = $this->Payments->Users->find(['list','contain' => ['Users', 'Partners']]);
        }
        
        $partners = $this->Payments->Partners->find('list', ['limit' => 200]);
        $planSubscribers = $this->Payments->PlanSubscribers->find('list', ['limit' => 200])
                ->where(['user_id'=>$payment['user_id']]);
        $this->set(compact('payment', 'users', 'partners', 'planSubscribers'));
    }

    /**
     * Delete method (Soft-delete with mandatory reason & privileged permissions)
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $userEmail = strtolower(trim($this->usersdetail['users_email']));
        if (!$this->canDeletePayment($userEmail)) {
            $this->Flash->error(__('Access Denied. You do not have permission to delete payments.'));
            return $this->redirect(['action' => 'index']);
        }
        
        if (empty($id)) {
            $id = $this->request->getData('payment_id') ?: ($this->request->getData('id') ?: ($this->request->data['payment_id'] ?? null));
        }

        if (empty($id)) {
            $this->Flash->error(__('Payment ID is missing.'));
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->request->is(['post', 'delete']) || !empty($this->request->data)) {
            $reason = trim($this->request->getData('deletion_reason') ?: ($this->request->data['deletion_reason'] ?? ''));
            if (empty($reason)) {
                $this->Flash->error(__('A Deletion Reason is mandatory when deleting a payment.'));
                return $this->redirect(['action' => 'index']);
            }
            
            $paymentRow = $this->Payments->find()->where(['id' => (int)$id])->first();
            $paymentUserId = $paymentRow ? $paymentRow->user_id : null;

            $userId = !empty($this->usersdetail['users_id']) ? $this->usersdetail['users_id'] : 1;
            $db = \Cake\Datasource\ConnectionManager::get('default');
            $updated = $db->execute(
                "UPDATE payments SET is_deleted = 1, deleted_by = ?, deleted_at = NOW(), deletion_reason = ? WHERE id = ?",
                [$userId, $reason, (int)$id]
            );

            // If user has no active payments left, ensure their active status is reverted to 2 (Enquiry)
            if ($paymentUserId) {
                $hasActivePayments = $this->Payments->find()
                    ->where(['user_id' => $paymentUserId, 'is_deleted' => 0, 'id !=' => (int)$id])
                    ->count();
                if ($hasActivePayments === 0) {
                    $usersTable = TableRegistry::get('Users');
                    $targetUser = $usersTable->find()->where(['id' => $paymentUserId])->first();
                    if ($targetUser && $targetUser->active == 1) {
                        $targetUser->active = 2; // Revert to Enquiry so payment can be retaken
                        $usersTable->save($targetUser);
                    }
                }
            }
            
            if ($updated) {
                $this->Flash->success(__('The payment has been deleted successfully.'));
            } else {
                $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Manage delegated payment delete permissions (Privileged roots only)
     */
    public function manageDeleteAccess()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $userEmail = strtolower(trim($this->usersdetail['users_email']));
        if (!$this->isPaymentDeleteRoot($userEmail)) {
            $this->Flash->error(__('Access Denied. Only primary administrators can manage delete permissions.'));
            return $this->redirect(['action' => 'index']);
        }

        $db = \Cake\Datasource\ConnectionManager::get('default');

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $action = $data['form_action'] ?? '';

            if ($action === 'add' && !empty($data['new_email'])) {
                $newEmail = strtolower(trim($data['new_email']));
                $db->execute(
                    "INSERT INTO payment_delete_permissions (email, granted_by, is_active, created, modified) VALUES (?, ?, 1, NOW(), NOW()) ON DUPLICATE KEY UPDATE is_active = 1, modified = NOW()",
                    [$newEmail, $userEmail]
                );
                $this->Flash->success(__('Delete permission granted to {0} successfully.', $newEmail));
            } elseif ($action === 'remove' && !empty($data['permission_id'])) {
                $target = $db->execute("SELECT email FROM payment_delete_permissions WHERE id = ?", [(int)$data['permission_id']])->fetch('assoc');
                if ($target && $this->isPaymentDeleteRoot($target['email'])) {
                    $this->Flash->error(__('Cannot revoke access from protected primary administrators.'));
                } else {
                    $db->execute("UPDATE payment_delete_permissions SET is_active = 0, modified = NOW() WHERE id = ?", [(int)$data['permission_id']]);
                    $this->Flash->success(__('Delete permission revoked.'));
                }
            }
            return $this->redirect(['action' => 'manageDeleteAccess']);
        }

        $accessList = $db->execute("SELECT * FROM payment_delete_permissions ORDER BY is_active DESC, created DESC")->fetchAll('assoc');
        $this->set(compact('accessList'));
    }

     public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
