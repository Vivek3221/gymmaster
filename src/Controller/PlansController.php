<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Plans Controller
 *
 * @property \App\Model\Table\PlansTable $Plans
 */
class PlansController extends AppController
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
        $this->Auth->allow(['index', 'add', 'edit', 'view']);
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }

    /**
     * GET /plans/get-days — AJAX: returns days for a given duration_months
     */
    public function getDays()
    {
        $this->autoRender = false;
        $months = (int)($this->request->query('months') ?? 0);
        $days = ($months == 12) ? 365 : ($months * 30);
        echo json_encode(['days' => $days]);
        exit;
    }

    /**
     * GET /plans/get-plan-details — AJAX: returns plan details by plan title for payment form
     */
    public function getPlanDetails()
    {
        $this->autoRender = false;
        $planId = (int)($this->request->query('plan_id') ?? 0);

        if (!$planId) {
            echo json_encode(['success' => false]);
            exit;
        }

        $Plans = TableRegistry::get('Plans');
        $plan  = $Plans->find()->where(['Plans.id' => $planId, 'Plans.active' => 1])->first();

        if (empty($plan)) {
            echo json_encode(['success' => false]);
            exit;
        }

        echo json_encode([
            'success' => true,
            'title'   => $plan->title,
            'days'    => (int)$plan->days,
            'price'   => (float)$plan->price,
        ]);
        exit;
    }

    /**
     * Index — Plans list with full CRUD (no delete)
     */
    public function index()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }

        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];
        $targetPartnerId = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($this->usersdetail['partner_id'])) ? $this->usersdetail['partner_id'] : $users_id);

        $conditions = [];
        if ($users_type != 1) {
            $conditions['Plans.partner_id'] = $targetPartnerId;
        }

        $this->paginate = ['limit' => 20, 'order' => ['Plans.id' => 'DESC']];
        $plans = $this->paginate($this->Plans->find('all')->where($conditions))->toArray();

        $this->set(compact('plans', 'users_type'));
    }

    /**
     * Add plan
     */
    public function add()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }

        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];
        $targetPartnerId = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($this->usersdetail['partner_id'])) ? $this->usersdetail['partner_id'] : $users_id);

        $plan = $this->Plans->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $months = (int)($data['duration_months'] ?? 0);
            $data['days']       = ($months == 12) ? 365 : ($months * 30);
            $data['partner_id'] = $targetPartnerId;
            $data['active']     = 1;

            $plan = $this->Plans->patchEntity($plan, $data);
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('Plan has been saved successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not save the plan. Please try again.'));
        }

        $durationOptions = [];
        for ($m = 1; $m <= 12; $m++) {
            $days = ($m == 12) ? 365 : ($m * 30);
            $durationOptions[$m] = "$m Month" . ($m > 1 ? "s" : "") . " ($days days)";
        }

        $this->set(compact('plan', 'durationOptions', 'users_type'));
    }

    /**
     * Edit plan
     */
    public function edit($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }

        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];
        $targetPartnerId = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($this->usersdetail['partner_id'])) ? $this->usersdetail['partner_id'] : $users_id);
        $plan       = $this->Plans->get($id);

        if ($users_type != 1 && $plan->partner_id != $targetPartnerId) {
            $this->Flash->error(__('You are not authorized to edit this plan.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data   = $this->request->data;
            $months = (int)($data['duration_months'] ?? 0);
            $data['days']       = ($months == 12) ? 365 : ($months * 30);
            $data['partner_id'] = $targetPartnerId;

            $plan = $this->Plans->patchEntity($plan, $data);
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('Plan has been updated successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Could not update the plan. Please try again.'));
        }

        $durationOptions = [];
        for ($m = 1; $m <= 12; $m++) {
            $days = ($m == 12) ? 365 : ($m * 30);
            $durationOptions[$m] = "$m Month" . ($m > 1 ? "s" : "") . " ($days days)";
        }

        $this->set(compact('plan', 'durationOptions', 'users_type'));
    }

    /**
     * View plan
     */
    public function view($id = null)
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }

        $plan = $this->Plans->get($id);
        $this->set(compact('plan'));
    }

    /**
     * Toggle active status
     */
    public function toggleStatus($id = null)
    {
        $this->autoRender = false;
        if (empty($this->usersdetail['users_name'])) {
            echo json_encode(['success' => false]);
            exit;
        }

        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];
        $targetPartnerId = ($users_type == 2) ? $users_id : (($users_type == 5 && !empty($this->usersdetail['partner_id'])) ? $this->usersdetail['partner_id'] : $users_id);

        $plan = $this->Plans->get($id);
        if ($users_type != 1 && $plan->partner_id != $targetPartnerId) {
            echo json_encode(['success' => false]);
            exit;
        }

        $plan->active = ($plan->active == 1) ? 0 : 1;
        $this->Plans->save($plan);

        echo json_encode(['success' => true, 'active' => $plan->active]);
        exit;
    }
}
