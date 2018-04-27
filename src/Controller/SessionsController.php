<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sessions Controller
 *
 * @property \App\Model\Table\SessionsTable $Sessions
 *
 * @method \App\Model\Entity\Session[] paginate($object = null, array $settings = [])
 */
class SessionsController extends AppController
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
        
        $user_type = $this->usersdetail['users_type'];
        $name = '';
        $norec = 10;
        $status = '';
        $search = [];
         if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Sessions.user_id'] = $name;
        }
         if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['Sessions.status'] = $status;
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        
        if (isset($search)) {
            $count = $this->Sessions->find('all')
                    ->where([$search]);
        } else {
            $count = $this->Sessions->find('all');
        }
        $count = $count->where(['Sessions.status !=' => '2']);
        $this->paginate = [
            'limit' => $norec, 
            'order' => ['Sessions.id' => 'DESC'],
            
        ];
        
        $this->paginate = [
            'contain' => ['Users']
        ];
        $sessions = $this->paginate($count);
        $users = $this->Sessions->Users->find('list')->where(['Users.active' => '1' ,'Users.user_type'=> '3']);
        $this->set(compact('sessions','name','status','norec','users','user_type'));
        $this->set('_serialize', ['sessions']);
    }

    /**
     * View method
     *
     * @param string|null $id Session id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
          if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $session = $this->Sessions->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('session', $session);
        $this->set('_serialize', ['session']);
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
        $user_type = $this->usersdetail['users_type'];
        $session = $this->Sessions->newEntity();
        if ($this->request->is('post')) {
             $data1 =[];
            $data = $this->request->data;
          
             if($user_type != 3)
        {
            $data1['partner_id'] = $this->usersdetail['users_id'];     
            $data1['user_id'] = $this->request->data['user_id'];     
        }   
        
            //pr($data); die;
                $data1['ex_detail'] = json_encode($data['excrcise']);
                $data1['status'] = $data['status'];
                $data1['date'] = $data['date'];
                
             //  pr($data1); die;
            $session = $this->Sessions->patchEntity($session, $data1);
           // pr($session); die;
            if ($this->Sessions->save($session)) {
                $this->Flash->success(__('The session has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The session could not be saved. Please, try again.'));
        }
//        $users = $this->Sessions->Users->find('list', ['limit' => 200]);
//        $partners = $this->Sessions->Partners->find('list', ['limit' => 200]);
        $this->set(compact('session', 'users', 'partners','user_type'));
        $this->set('_serialize', ['session']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Session id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
          if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $session = $this->Sessions->get($id, [
            'contain' => []
        ]);
        $user_type = $this->usersdetail['users_type'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data1 =[];
            $data = $this->request->data;
       //   pr($data); die;
             if($user_type != 3)
        {
            $data1['partner_id'] = $this->usersdetail['users_id'];     
            $data1['user_id'] = $this->request->data['user_id'];     
        }     
                 $data1['ex_detail'] = json_encode($data['excrcise']);
                $data1['status'] = $data['status'];
                $data1['date'] = $data['date'];
                
             //   pr($data1); die;
            $session = $this->Sessions->patchEntity($session, $data1);
            if ($this->Sessions->save($session)) {
                $this->Flash->success(__('The session has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The session could not be saved. Please, try again.'));
        }
         $session_values = json_decode($session->ex_detail);
      // pr($session_values); die;
        //$users = $this->Sessions->Users->find('list', ['limit' => 200]);
       // $partners = $this->Sessions->Partners->find('list', ['limit' => 200]);
        $this->set(compact('session', 'users', 'partners','user_type','session_values'));
        $this->set('_serialize', ['session']);
    }
    public function userEdit($id = null)
    {
      //  echo 'ffffffff'; die;
          if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $session = $this->Sessions->get($id, [
            'contain' => []
        ]);
        $user_type = $this->usersdetail['users_type'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data1 =[];
            $data = $this->request->data;
            
            $data1['user_detail'] = json_encode($data['userexcrcise']);
               
             //  pr($data1); die;
            $session = $this->Sessions->patchEntity($session, $data1);
            if ($this->Sessions->save($session)) {
                $this->Flash->success(__('The session has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The session could not be saved. Please, try again.'));
        }
         $session_values = json_decode($session->ex_detail);
      // pr($session_values); die;
        //$users = $this->Sessions->Users->find('list', ['limit' => 200]);
       // $partners = $this->Sessions->Partners->find('list', ['limit' => 200]);
        $this->set(compact('session', 'users', 'partners','user_type','session_values'));
        $this->set('_serialize', ['session']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Session id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
          if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
       // $this->request->allowMethod(['post', 'delete']);
        $session = $this->Sessions->get($id);
        if ($this->Sessions->delete($session)) {
            $this->Flash->success(__('The session has been deleted.'));
        } else {
            $this->Flash->error(__('The session could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function status() {
                       if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $id = $this->request->params['pass'][0];
        $status = $this->request->params['pass'][1];
        $user = $this->Sessions->get($id);
        if ($status == 1) {
            $user_data['status'] = 0;
            $user_data['id'] = $id;
            $user = $this->Sessions->patchEntity($user, $user_data);
            if ($this->Sessions->save($user)) {
                $st = $user_data['status'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                // echo "<a href= '#' onclick = 'updateStatus(" . $id . "," . $user_data['status'] . ")'> " . $st . " </a>";
                echo '<button id=' . $id . ' class="btn btn-primary waves-effect status" value=' . $user_data['status'] . ' onclick="updateStatus(this.id,' . $user_data['status'] . ')" type="submit">Inactive</button>';
                exit;
            }
        } else {
            $user_data['status'] = 1;
            $user_data['id'] = $id;
            $user = $this->Sessions->patchEntity($user, $user_data);
            if ($this->Sessions->save($user)) {
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
