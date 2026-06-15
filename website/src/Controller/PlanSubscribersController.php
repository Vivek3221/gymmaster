<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * PlanSubscribers Controller
 *
 * @property \App\Model\Table\PlanSubscribersTable $PlanSubscribers
 *
 * @method \App\Model\Entity\PlanSubscriber[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlanSubscribersController extends AppController
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
        
        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        
        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = str_replace(',','',$this->request->query['name']);
            $search['OR'] = ['PlanSubscribers.fee'=>$name,'Users.name REGEXP'=>$name,'PlanSubscribers.plan_name REGEXP'=>$name];
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['PlanSubscribers.partner_id'] = $partner;
        }
        if (isset($this->request->query['payments']) && trim($this->request->query['payments']) != "") {
            $payment = date('Y-m-d');
            $search['PlanSubscribers.payment_due_date <'] = $payment;
        }
        if (isset($this->request->query['planexp']) && trim($this->request->query['planexp']) != "") {
            $payment = date('Y-m-d');
            $search['PlanSubscribers.plan_expire_date <'] = $payment;
        }
        
        if (!empty($search)) {
            $this->Amount = $this->PlanSubscribers->find()
                    ->contain(['Users'])
                    ->select(['total_amount' => 'SUM(fee)'])->where([$search]);
            $this->PlanSubscribers = $this->PlanSubscribers->find('all')
                    ->where([$search]);
        } else {
            $this->Amount = $this->PlanSubscribers->find()->contain(['Users'])->select(['total_amount' => 'SUM(fee)']);
            $this->PlanSubscribers = $this->PlanSubscribers->find('all');
        }
        $total_amount = $this->Amount->where(['Users.active !=' => '3','Users.user_type !='=>'1'])->first();
        $amount = $total_amount->total_amount;
        $this->PlanSubscribers = $this->PlanSubscribers->where(['Users.active !=' => '3','Users.user_type !='=>'1']);

        $partners =  $this->Users->find('list')
                                 ->select(['id','name'])
                                ->where(['user_type'=> 2])
                                ->toArray();
        $this->paginate = [
            'limit' => $norec,
            'contain' => ['Users', 'Partners'],
            'order' => ['id' => 'DESC']
        ];
        $planSubscribers = $this->paginate($this->PlanSubscribers);
        $this->set(compact('planSubscribers','users', 'name', 'status', 'norec','mode_ofpay','user_type','users_type','partners','partner','amount'));
    }

    /**
     * View method
     *
     * @param string|null $id Plan Subscriber id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $planSubscriber = $this->PlanSubscribers->get($id, [
            'contain' => ['Users', 'Partners', 'Payments']
        ]);

        $this->set('planSubscriber', $planSubscriber);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $planSubscriber = $this->PlanSubscribers->newEntity();
        if ($this->request->is('post')) {
            $planSubscriber = $this->PlanSubscribers->patchEntity($planSubscriber, $this->request->getData());
            if ($this->PlanSubscribers->save($planSubscriber)) {
                $this->Flash->success(__('The plan subscriber has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plan subscriber could not be saved. Please, try again.'));
        }
        $users = $this->PlanSubscribers->Users->find('list', ['limit' => 200]);
        $partners = $this->PlanSubscribers->Partners->find('list', ['limit' => 200]);
        $this->set(compact('planSubscriber', 'users', 'partners'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Plan Subscriber id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        $planSubscriber = $this->PlanSubscribers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $planSubscriber = $this->PlanSubscribers->patchEntity($planSubscriber, $this->request->getData());
            if ($this->PlanSubscribers->save($planSubscriber)) {
                $this->Flash->success(__('The plan subscriber has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The plan subscriber could not be saved. Please, try again.'));
        }
        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        $search['Users.user_type'] = 3;
        if (!empty($search)) {
            $users = $this->PlanSubscribers->Users->find('list')
                    ->where([$search]);
        } else {
            $users = $this->PlanSubscribers->Users->find('list');
        }
        
        $partners = $this->PlanSubscribers->Partners->find('list', ['limit' => 200]);
        $this->set(compact('planSubscriber', 'users', 'partners'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Plan Subscriber id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       // $this->request->allowMethod(['post', 'delete']);
        $planSubscriber = $this->PlanSubscribers->get($id);
        if ($this->PlanSubscribers->delete($planSubscriber)) {
            $this->Flash->success(__('The plan subscriber has been deleted.'));
        } else {
            $this->Flash->error(__('The plan subscriber could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
