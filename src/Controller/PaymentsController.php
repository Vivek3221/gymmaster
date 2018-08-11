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
        $startDate = '01-01-2017';
        $endDate = date('d/m/Y');
        
        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
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
            $dateArray = explode(' - ',$created);
            $startDate = $dateArray[0];
            $endDate = $dateArray[1];
            $startDateArray = explode('/',$startDate);
            $startDate_u = $startDateArray[2].'-'.$startDateArray[1].'-'.$startDateArray[0];
            $endDateArray = explode('/',$endDate);
            $endDate_u = $endDateArray[2].'-'.$endDateArray[1].'-'.$endDateArray[0];
            $search['date(Payments.created) >='] = $startDate_u;
            $search['date(Payments.created) <='] = $endDate_u;
        }
        if (!empty($search)) {
            $this->Amount = $this->Payments->find()
                    ->contain(['Users','PlanSubscribers'])
                    ->select(['total_amount' => 'SUM(amount)'])->where([$search]);
            $this->Payments = $this->Payments->find('all')
                    ->where([$search]);
        } else {
            $this->Amount = $this->Payments->find()->contain(['Users','PlanSubscribers'])->select(['total_amount' => 'SUM(amount)']);
            $this->Payments = $this->Payments->find('all');
            
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

        $this->set(compact('payments','users', 'name', 'status', 'norec','mode_ofpay','user_type',
                'users_type','partners','partner','amount','startDate','endDate'));
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
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
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
        //$this->request->allowMethod(['post', 'delete']);
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
