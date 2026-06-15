<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;



/**
 * Bodies Controller
 *
 * @property \App\Model\Table\BodiesTable $Bodies
 *
 * @method \App\Model\Entity\Body[] paginate($object = null, array $settings = [])
 */
class BodiesController extends AppController
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
        
        
        $name = '';
        $norec = 10;
        $status = '';
        $search = [];
        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Bodies.name REGEXP'] = $name;
        }
        if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['Bodies.status'] = $status;
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
         if (isset($search)) {
            $count = $this->Bodies->find('all')
                    ->where([$search]);
        } else {
            $count = $this->Bodies->find('all');
        }
        $count = $count->where(['Bodies.status !=' => '2']);

        $this->paginate = ['limit' => $norec, 'order' => ['Bodies.id' => 'DESC']];

        $bodies = $this->paginate($count)->toArray();
        

        $this->set(compact('bodies','name', 'status', 'norec'));
        $this->set('_serialize', ['bodies']);
    }

    /**
     * View method
     *
     * @param string|null $id Body id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        
             if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $body = $this->Bodies->get($id);

        $this->set('body', $body);
        $this->set('_serialize', ['body']);
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
        $body = $this->Bodies->newEntity();
        if ($this->request->is('post')) {
            $body = $this->Bodies->patchEntity($body, $this->request->getData());
            if ($this->Bodies->save($body)) {
                $this->Flash->success(__('The body has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The body could not be saved. Please, try again.'));
        }
        $this->set(compact('body'));
        $this->set('_serialize', ['body']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Body id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
            if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $body = $this->Bodies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $body = $this->Bodies->patchEntity($body, $this->request->getData());
            if ($this->Bodies->save($body)) {
                $this->Flash->success(__('The body has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The body could not be saved. Please, try again.'));
        }
        $this->set(compact('body'));
        $this->set('_serialize', ['body']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Body id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
            if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        //$this->request->allowMethod(['post', 'delete']);
        $body = $this->Bodies->get($id);
        if ($this->Bodies->delete($body)) {
            $this->Flash->success(__('The body has been deleted.'));
        } else {
            $this->Flash->error(__('The body could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
    
      public function status() {
                       if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $id = $this->request->params['pass'][0];
        $status = $this->request->params['pass'][1];
        $user = $this->Bodies->get($id);
        if ($status == 1) {
            $user_data['status'] = 0;
            $user_data['id'] = $id;
            $user = $this->Bodies->patchEntity($user, $user_data);
            if ($this->Bodies->save($user)) {
                $st = $user_data['status'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                // echo "<a href= '#' onclick = 'updateStatus(" . $id . "," . $user_data['status'] . ")'> " . $st . " </a>";
                echo '<button id=' . $id . ' class="btn btn-primary waves-effect status" value=' . $user_data['status'] . ' onclick="updateStatus(this.id,' . $user_data['status'] . ')" type="submit">Inactive</button>';
                exit;
            }
        } else {
            $user_data['status'] = 1;
            $user_data['id'] = $id;
            $user = $this->Bodies->patchEntity($user, $user_data);
            if ($this->Bodies->save($user)) {
                $st = $user_data['status'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                echo '<button id=' . $id . ' class="btn btn-success waves-effect status" value=' . $user_data['status'] . ' onclick="updateStatus(this.id,' . $user_data['status'] . ')" type="submit">Active</button>';
                exit;
            }
        }
    }
    
     public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
