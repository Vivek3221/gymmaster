<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $this->paginate = [
            'contain' => ['Users', 'Partners'],
            'order' => ['id' => 'DESC']
        ];
        $planSubscribers = $this->paginate($this->PlanSubscribers);

        $this->set(compact('planSubscribers'));
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
        $users = $this->PlanSubscribers->Users->find('list', ['limit' => 200]);
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
