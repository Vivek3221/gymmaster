<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaymentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];

         if (isset($this->request->query['search_name']) && ($this->request->query['search_name'] != "")) {
            $search_name = $this->request->query['search_name'];
            $search['Users.name LIKE'] = '%' . $search_name . '%';
        }
         if (isset($this->request->query['partner_id']) && ($this->request->query['partner_id'] != "")) {
            $partner_id = $this->request->query['partner_id'];
            $search['Users.partner_id'] = $partner_id;
        }

        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        $search['Users.user_type'] = 3;
        
        $this->paginate = [
            'contain' => ['Users', 'Partners', 'PlanSubscribers']
        ];
        if (!empty($search)) {
            $payments = $this->Payments->find('all')
                    ->contain(['Users', 'Partners', 'PlanSubscribers'])
                    ->where([$search])->order(['Payments.id' => 'DESC']);
        } else {
            $payments = $this->Payments->find('all')
                    ->contain(['Users', 'Partners', 'PlanSubscribers'])
                    ->order(['Payments.id' => 'DESC']);
        }
          $partners =  $this->Payments->Users->find('list')
              ->select(['id','name'])  
               ->where(['user_type'=>2])
              ->toArray();
       // $payments = $this->paginate($this->Payments);

        $this->set(compact('payments','users_type','partners'));
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payment = $this->Payments->get($id, [
            'contain' => ['Users', 'Partners', 'PlanSubscribers']
        ]);

        $this->set('payment', $payment);
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
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (isset($users_type) && ($users_type == 2)) {
                 $data['partner_id'] = $users_id;
            }else{
                 $user_partner = $this->Payments->Users->get($data['user_id']);
                  $data['partner_id'] = $user_partner['partner_id'];
            }
             $data['payment_date'] = date('Y-m-d');
           
            $payment = $this->Payments->patchEntity($payment, $data);
             $payment->mode_ofpay = $data['mode_ofpay'];
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
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
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $payment = $this->Payments->patchEntity($payment, $data);
            $payment->mode_ofpay = $data['mode_ofpay'];
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
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
                ->where(['user_id'=>$payment['user_id'],'partner_id'=>$this->usersdetail['users_id']]);
        $this->set(compact('payment', 'users', 'partners', 'planSubscribers'));
    }

    /**
     * Delete method
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
        if ($this->usersdetail['users_type'] == 5) {
            $this->Flash->error(__('Front Desk role is restricted from deleting payment records.'));
            return $this->redirect(['action' => 'index']);
        }
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

     public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
