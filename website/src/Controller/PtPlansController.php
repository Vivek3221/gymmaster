<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * PtPlans Controller
 */
class PtPlansController extends AppController
{
    private function checkAccess()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $email = strtolower(trim($this->usersdetail['users_email']));
        $userType = $this->usersdetail['users_type'];
        
        $common = new \App\View\Helper\CommonHelper(new \Cake\View\View());
        if ($common->canAccessPtModule($userType, $email)) {
            return null;
        }

        $this->Flash->error(__('You do not have permission to access this module.'));
        return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('PtPlans');
        $this->loadModel('UserPtSubscriptions');
        $this->loadModel('Users');
    }

    /**
     * List all PT Master Plans
     */
    public function index()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $email = strtolower(trim($this->usersdetail['users_email']));
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $conditions = ['PtPlans.status' => 1];
        if (!$isGlobal) {
            $conditions['PtPlans.partner_id'] = $userId;
        }

        $query = $this->PtPlans->find()
            ->contain(['Partners'])
            ->where($conditions)
            ->order(['PtPlans.id' => 'DESC']);

        $ptPlans = $query->all();
        $this->set(compact('ptPlans', 'isGlobal'));
    }

    /**
     * Create a new PT Master Plan
     */
    public function add()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $ptPlan = $this->PtPlans->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['partner_id'] = ($userType == 1 && !empty($data['partner_id'])) ? $data['partner_id'] : $userId;

            $durationMonths = max(1, (int)($data['duration_months'] ?? 1));
            $totalClasses = max(1, (int)($data['total_classes'] ?? ($durationMonths * 12)));
            $price = max(0, (float)($data['price'] ?? 0));

            $data['duration_months'] = $durationMonths;
            $data['total_classes'] = $totalClasses;
            $data['per_class_rate'] = $totalClasses > 0 ? round($price / $totalClasses, 2) : 0;

            $ptPlan = $this->PtPlans->patchEntity($ptPlan, $data);
            if ($this->PtPlans->save($ptPlan)) {
                $this->Flash->success(__('PT Master Plan created successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Failed to create PT Plan. Please check inputs.'));
        }

        $partners = [];
        if ($userType == 1) {
            $partners = $this->Users->find('list')
                ->where(['user_type' => 2, 'active !=' => 3])
                ->toArray();
        }

        $this->set(compact('ptPlan', 'partners', 'userType'));
    }

    /**
     * Edit PT Master Plan
     */
    public function edit($id = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $ptPlan = $this->PtPlans->get($id);

        if ($this->request->is(['post', 'put', 'patch'])) {
            $data = $this->request->getData();
            $durationMonths = max(1, (int)($data['duration_months'] ?? $ptPlan->duration_months));
            $totalClasses = max(1, (int)($data['total_classes'] ?? $ptPlan->total_classes));
            $price = max(0, (float)($data['price'] ?? $ptPlan->price));

            $data['duration_months'] = $durationMonths;
            $data['total_classes'] = $totalClasses;
            $data['per_class_rate'] = $totalClasses > 0 ? round($price / $totalClasses, 2) : 0;

            $ptPlan = $this->PtPlans->patchEntity($ptPlan, $data);
            if ($this->PtPlans->save($ptPlan)) {
                $this->Flash->success(__('PT Master Plan updated successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Failed to update PT Plan.'));
        }

        $this->set(compact('ptPlan'));
    }

    /**
     * Delete / Deactivate PT Master Plan
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $ptPlan = $this->PtPlans->get($id);
        $ptPlan->status = 0;
        if ($this->PtPlans->save($ptPlan)) {
            $this->Flash->success(__('PT Master Plan deleted.'));
        } else {
            $this->Flash->error(__('Failed to delete PT Master Plan.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Assign PT Plan to Member / Client
     */
    public function assign($userId = null)
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $partnerId = $this->usersdetail['users_id'];
        $userType = $this->usersdetail['users_type'];
        $subscription = $this->UserPtSubscriptions->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $ptPlan = $this->PtPlans->get((int)$data['pt_plan_id']);

            $customPrice = !empty($data['price']) ? (float)$data['price'] : (float)$ptPlan->price;
            $totalClasses = !empty($data['total_classes']) ? (int)$data['total_classes'] : (int)$ptPlan->total_classes;
            $clientPerClassRate = $totalClasses > 0 ? round($customPrice / $totalClasses, 2) : 0;

            $startDate = !empty($data['start_date']) ? date('Y-m-d', strtotime($data['start_date'])) : date('Y-m-d');
            $endDate = !empty($data['end_date']) ? date('Y-m-d', strtotime($data['end_date'])) : date('Y-m-d', strtotime("+$ptPlan->duration_months month"));

            $subData = [
                'partner_id' => ($userType == 1 && !empty($data['partner_id'])) ? $data['partner_id'] : $partnerId,
                'user_id' => $data['user_id'],
                'trainer_id' => $data['trainer_id'],
                'pt_plan_id' => $ptPlan->id,
                'plan_name' => $ptPlan->title,
                'total_classes' => $totalClasses,
                'completed_classes' => 0,
                'total_amount' => $customPrice,
                'client_per_class_rate' => $clientPerClassRate,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => 'Active'
            ];

            $subscription = $this->UserPtSubscriptions->patchEntity($subscription, $subData);
            if ($this->UserPtSubscriptions->save($subscription)) {
                // Update user's assigned trainer_userid if not set
                $db = $this->Users->getConnection();
                $db->execute("UPDATE users SET trainer_userid = ? WHERE id = ? AND (trainer_userid IS NULL OR trainer_userid = 0)", [(int)$data['trainer_id'], (int)$data['user_id']]);

                $this->Flash->success(__('PT Plan successfully assigned to member.'));
                return $this->redirect(['action' => 'subscriptions']);
            }
            $this->Flash->error(__('Failed to assign PT Plan.'));
        }

        // Fetch Users (Members)
        $userConditions = ['Users.user_type' => 3, 'Users.active !=' => 3];
        if ($userType == 2) {
            $userConditions['Users.partner_id'] = $partnerId;
        }
        $usersList = $this->Users->find('list')->where($userConditions)->toArray();

        // Fetch Trainers
        $trainerConditions = ['Users.user_type' => 4, 'Users.active !=' => 3];
        if ($userType == 2) {
            $trainerConditions['Users.partner_id'] = $partnerId;
        }
        $trainersList = $this->Users->find('list')->where($trainerConditions)->toArray();

        // Fetch Available PT Plans
        $planConditions = ['PtPlans.status' => 1];
        if ($userType == 2) {
            $planConditions['PtPlans.partner_id'] = $partnerId;
        }
        $ptPlans = $this->PtPlans->find('all')->where($planConditions)->toArray();

        $selectedUserId = $userId;
        $this->set(compact('subscription', 'usersList', 'trainersList', 'ptPlans', 'selectedUserId', 'userType'));
    }

    /**
     * View Client PT Subscriptions List
     */
    public function subscriptions()
    {
        $redirect = $this->checkAccess();
        if ($redirect) return $redirect;

        $userType = $this->usersdetail['users_type'];
        $userId = $this->usersdetail['users_id'];
        $email = strtolower(trim($this->usersdetail['users_email']));
        $allowedEmails = ['ad1234@yopmail.com', 'mukeshkr3221@gmail.com'];
        $isGlobal = ($userType == 1 || in_array($email, $allowedEmails));

        $conditions = [];
        if (!$isGlobal) {
            $conditions['UserPtSubscriptions.partner_id'] = $userId;
        }

        $query = $this->UserPtSubscriptions->find()
            ->contain(['Users', 'Trainers', 'Partners', 'PtPlans'])
            ->where($conditions)
            ->order(['UserPtSubscriptions.id' => 'DESC']);

        $subscriptions = $query->all();
        $this->set(compact('subscriptions', 'isGlobal'));
    }

    /**
     * AJAX Endpoint: Get Active PT Subscription Info for a selected User
     */
    public function getUserPtInfo($userId = null)
    {
        $this->autoRender = false;
        $this->request->allowMethod(['get']);

        if (empty($userId)) {
            echo json_encode(['status' => 'error', 'message' => 'User ID is required']);
            exit;
        }

        $subscription = $this->UserPtSubscriptions->find()
            ->contain(['PtPlans', 'Trainers'])
            ->where([
                'UserPtSubscriptions.user_id' => $userId,
                'UserPtSubscriptions.status' => 'Active'
            ])
            ->order(['UserPtSubscriptions.id' => 'DESC'])
            ->first();

        if ($subscription) {
            $remainingClasses = max(0, $subscription->total_classes - $subscription->completed_classes);
            echo json_encode([
                'status' => 'success',
                'has_pt_plan' => true,
                'subscription_id' => $subscription->id,
                'plan_name' => $subscription->plan_name,
                'trainer_id' => $subscription->trainer_id,
                'trainer_name' => $subscription->trainer ? $subscription->trainer->name : '',
                'total_amount' => (float)$subscription->total_amount,
                'total_classes' => (int)$subscription->total_classes,
                'completed_classes' => (int)$subscription->completed_classes,
                'remaining_classes' => $remainingClasses,
                'client_per_class_rate' => (float)$subscription->client_per_class_rate
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'has_pt_plan' => false,
                'message' => 'No active PT plan found for this user.'
            ]);
        }
        exit;
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
