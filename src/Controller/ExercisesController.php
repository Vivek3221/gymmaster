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
    
     public function beforeFilter(Event $event) 
     {
        parent::beforeFilter($event);
       // $this->Users->userAuth = $this->UserAuth;
        $this->Auth->allow(['index','add','view','delete','edit','status','privacyPolicy']);
        
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
        $name = '';
        $bodie ='';
        $norec = 10;
        $status = '';
        $search = [];
        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Exercises.name REGEXP'] = $name;
        }
        if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['Exercises.status'] = $status;
        }
        if (isset($this->request->query['body_id']) && trim($this->request->query['body_id']) != "") {
            $bodie = $this->request->query['body_id'];
            $search['Exercises.body_id'] = $bodie;
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        if (isset($search)) {
            $count = $this->Exercises->find('all')
                    ->where([$search]);
        } else {
            $count = $this->Exercises->find('all');
        }
        $count = $count->where(['Exercises.status !=' => '2']);

        
        $this->paginate = [
            'limit' => $norec, 
            'order' => ['Exercises.id' => 'DESC'],
            'contain' => ['Bodies']
        ];
         $exercises = $this->paginate($count);
         $bodies = $this->Exercises->Bodies->find('list', ['limit' => 200])->where(['Bodies.status' => '1']);

        $this->set(compact('exercises','name','status','norec','bodies','bodie'));
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
        $bodies = $this->Exercises->Bodies->find('list', ['limit' => 200])->where(['Bodies.status' => '1']);

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
    
     public function status() {
                       if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $id = $this->request->params['pass'][0];
        $status = $this->request->params['pass'][1];
        $user = $this->Exercises->get($id);
        if ($status == 1) {
            $user_data['status'] = 0;
            $user_data['id'] = $id;
            $user = $this->Exercises->patchEntity($user, $user_data);
            if ($this->Exercises->save($user)) {
                $st = $user_data['status'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                // echo "<a href= '#' onclick = 'updateStatus(" . $id . "," . $user_data['status'] . ")'> " . $st . " </a>";
                echo '<button id=' . $id . ' class="btn btn-primary waves-effect status" value=' . $user_data['status'] . ' onclick="updateStatus(this.id,' . $user_data['status'] . ')" type="submit">Inactive</button>';
                exit;
            }
        } else {
            $user_data['status'] = 1;
            $user_data['id'] = $id;
            $user = $this->Exercises->patchEntity($user, $user_data);
            if ($this->Exercises->save($user)) {
                $st = $user_data['status'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                echo '<button id=' . $id . ' class="btn btn-success waves-effect status" value=' . $user_data['status'] . ' onclick="updateStatus(this.id,' . $user_data['status'] . ')" type="submit">Active</button>';
                exit;
            }
        }
    }
    
    public function privacyPolicy(){

    }

     public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
