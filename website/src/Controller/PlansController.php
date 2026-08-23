<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Plans Controller
 */
class PlansController extends AppController
{
    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }

    /**
     * Index method
     */
    public function index()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }

        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];

        $conditions = [];
        if ($users_type != 1) {
            $conditions['Plans.partner_id'] = $users_id;
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
        if ($this->usersdetail['users_type'] == 5) {
            $this->Flash->error(__('Front Desk role is restricted from modifying plans.'));
            return $this->redirect(['action' => 'index']);
        }

        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];

        $plan = $this->Plans->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $months = (int)($data['duration_months'] ?? 0);
            $data['days']       = ($months == 12) ? 365 : ($months * 30);
            $data['partner_id'] = $users_id;
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
        if ($this->usersdetail['users_type'] == 5) {
            $this->Flash->error(__('Front Desk role is restricted from modifying plans.'));
            return $this->redirect(['action' => 'index']);
        }

        $users_type = $this->usersdetail['users_type'];
        $users_id   = $this->usersdetail['users_id'];
        $plan       = $this->Plans->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data   = $this->request->data;
            $months = (int)($data['duration_months'] ?? 0);
            $data['days']       = ($months == 12) ? 365 : ($months * 30);
            $data['partner_id'] = $users_id;

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
        if (empty($this->usersdetail['users_name']) || $this->usersdetail['users_type'] == 5) {
            echo json_encode(['success' => false]);
            exit;
        }

        $plan = $this->Plans->get($id);
        $plan->active = ($plan->active == 1) ? 0 : 1;
        $this->Plans->save($plan);

        echo json_encode(['success' => true, 'active' => $plan->active]);
        exit;
    }
}
