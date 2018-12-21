<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Diets Controller
 *
 * @property \App\Model\Table\DietsTable $Diets
 *
 * @method \App\Model\Entity\Diet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DietsController extends AppController
{

    public function initialize()
    {

        parent::initialize();
        $this->loadComponent('Flash'); 
    }
    
     public function beforeFilter(Event $event) 
     {
        parent::beforeFilter($event);
       // $this->Users->userAuth = $this->UserAuth;
        $this->Auth->allow(['index','add','view','delete','edit','status']);
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Partners']
        ];
        $diets = $this->paginate($this->Diets);

        $this->set(compact('diets'));
    }

    /**
     * View method
     *
     * @param string|null $id Diet id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diet = $this->Diets->get($id, [
            'contain' => ['Users', 'Partners']
        ]);

        $this->set('diet', $diet);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $diet = $this->Diets->newEntity();
        if ($this->request->is('post')) {
            $diet = $this->Diets->patchEntity($diet, $this->request->getData());
            if ($this->Diets->save($diet)) {
                $this->Flash->success(__('The diet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diet could not be saved. Please, try again.'));
        }
        $users = $this->Diets->Users->find('list', ['limit' => 200]);
        $partners = $this->Diets->Partners->find('list', ['limit' => 200]);
        $this->set(compact('diet', 'users', 'partners'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Diet id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diet = $this->Diets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diet = $this->Diets->patchEntity($diet, $this->request->getData());
            if ($this->Diets->save($diet)) {
                $this->Flash->success(__('The diet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diet could not be saved. Please, try again.'));
        }
        $users = $this->Diets->Users->find('list', ['limit' => 200]);
        $partners = $this->Diets->Partners->find('list', ['limit' => 200]);
        $this->set(compact('diet', 'users', 'partners'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Diet id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $diet = $this->Diets->get($id);
        if ($this->Diets->delete($diet)) {
            $this->Flash->success(__('The diet has been deleted.'));
        } else {
            $this->Flash->error(__('The diet could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
