<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Exercises Controller
 *
 * @property \App\Model\Table\ExercisesTable $Exercises
 *
 * @method \App\Model\Entity\Exercise[] paginate($object = null, array $settings = [])
 */
class ExercisesController extends AppController
{
      public function initialize()
    {

        parent::initialize();
        $this->loadComponent('Flash'); 
    }
    
     public function beforeFilter(Event $event) {
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
         if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $this->paginate = [
            'contain' => ['Bodies']
        ];
        $exercises = $this->paginate($this->Exercises);

        $this->set(compact('exercises'));
        $this->set('_serialize', ['exercises']);
    }

    /**
     * View method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    { 
         if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $exercise = $this->Exercises->get($id, [
            'contain' => ['Bodies']
        ]);

        $this->set('exercise', $exercise);
        $this->set('_serialize', ['exercise']);
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
        $exercise = $this->Exercises->newEntity();
        if ($this->request->is('post')) {
            $exercise = $this->Exercises->patchEntity($exercise, $this->request->getData());
            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('The exercise has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
        }
        $bodies = $this->Exercises->Bodies->find('list', ['limit' => 200]);
        $this->set(compact('exercise', 'bodies'));
        $this->set('_serialize', ['exercise']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    { 
         if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $exercise = $this->Exercises->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exercise = $this->Exercises->patchEntity($exercise, $this->request->getData());
            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('The exercise has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
        }
        $bodies = $this->Exercises->Bodies->find('list', ['limit' => 200]);
        $this->set(compact('exercise', 'bodies'));
        $this->set('_serialize', ['exercise']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    { 
         if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        //$this->request->allowMethod(['post', 'delete']);
        $exercise = $this->Exercises->get($id);
        if ($this->Exercises->delete($exercise)) {
            $this->Flash->success(__('The exercise has been deleted.'));
        } else {
            $this->Flash->error(__('The exercise could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
     public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
