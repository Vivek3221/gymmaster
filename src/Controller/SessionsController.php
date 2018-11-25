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
        $users_id = $this->usersdetail['users_id'];
        $name = '';
        $sdate ='';
        $edate ='';
        $norec = 10;
        $status = '';
        $partner = '';
        $search = [];
         if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Sessions.user_id'] = $name;
        }
        //sessions=notedit
         if (isset($this->request->query['sessions']) && trim($this->request->query['sessions']) != "") {
            $sessions_value = $this->request->query['sessions'];
            //$search['Sessions.user_id'] = $name;
        }
         if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['Sessions.partner_id'] = $partner;
        }
         if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['Sessions.status'] = $status;
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        if (isset($this->request->query['from_date']) && trim($this->request->query['from_date']) != "" && isset($this->request->query['to_date']) && trim($this->request->query['to_date']) != "" ) {
          
            $sdate = date('Y-m-d H:i:s',strtotime($this->request->query['from_date'])); 
            $edate = date('Y-m-d H:i:s',strtotime($this->request->query['to_date'])) ;

            $search['Sessions.date >='] = $sdate;
            $search['Sessions.date <='] = $edate;  
            $sdate = $this->request->query['from_date']; 
            $edate = $this->request->query['to_date'] ;

             
        }
        
        
        if (isset($user_type) && ($user_type == 3)) {
          $search['Sessions.user_id'] = $users_id;
          }
        if (isset($user_type) && ($user_type == 2)) {
          $search['Users.partner_id'] = $users_id;
          }
        if (isset($user_type) && ($user_type == 4)) {
          $search['Users.trainer_userid'] = $users_id;
          }  
        if (isset($search)) {
            $count = $this->Sessions->find('all')
                    ->where([$search])
                     ->order(['date' => 'DESC']);;
        } else {
            $count = $this->Sessions->find('all');
        }
        if (isset($user_type) && ($user_type == 3)) {
        $count = $count->where(['Sessions.status ' => '1' ,'Sessions.date <=' => date('Y-m-d')]);
        } else {
             $count = $count->where(['Sessions.status !=' => '2']);
        }
        if(isset($sessions_value) && !empty($sessions_value))
        {
           $count = $count->where(['date <' => date('Y-m-d') ,'user_detail Is Null']);  
        }
        $this->paginate = [
            'contain' => ['Users'],
            'limit' => $norec, 
            'order' => ['Sessions.id' => 'DESC'],
            
        ];
        
       
        $sessions = $this->paginate($count);
        if($user_type == 4){
         $users = $this->Sessions->Users->find('list')->where(['Users.active' => '1' ,'Users.trainer_userid'=> $users_id,'user_type' =>3]);
            }else{
           $users = $this->Sessions->Users->find('list')->where(['Users.active' => '1' ,'Users.partner_id'=> $users_id,'user_type' =>3]);
        }
       

       // $partners = $this->Sessions->Users->find('list')->where(['Users.active' => '1' ,'Users.partner_id'=> $users_id,'user_type' =>2]);
        $this->set(compact('sessions','name','status','norec','users','user_type','sdate','edate','partner'));
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
           $users_id = $this->usersdetail['users_id'];
        $session = $this->Sessions->get($id, [
            'contain' => ['Users']
        ]);
   
      $session_values = json_decode($session->ex_detail);
//pr($session_values);
      $user_values = json_decode($session->user_detail);
//pr($user_values); die;

        $this->set(compact('session', 'user_values', 'partners','user_type','session_values','users_id'));
        $this->set('_serialize', ['session']);
    }

    public function newview(){
        
         

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
       // pr($this->usersdetail); die;
        $user_type  = $this->usersdetail['users_type'];
        $partner_id = $this->usersdetail['partner_id'];
        $users_id   = $this->usersdetail['users_id'];
        $session    = $this->Sessions->newEntity();
        if ($this->request->is('post')) {
             $data1 =[];
            $data = $this->request->data;
            $users = $this->request->data['user_id'];
    // if($data); die;
            $dates = explode(',',substr($data['date'],0,-1));
            foreach($dates as $date) {
                foreach($users as $value)
                {
                   if($user_type != 3)
              {
                  $data1['partner_id'] = $this->usersdetail['users_id'];     
                  $data1['user_id'] = $value;     
              }   
                      $data1['ex_detail'] = json_encode($data['excrcise']);
                      $data1['status'] = $data['status'];
                      $data1['date'] = $date;

                   //  pr($data1); die;
                      $sessione = $this->Sessions->newEntity();
                  $session = $this->Sessions->patchEntity($sessione, $data1);
                 // pr($session); die;
                  if ($this->Sessions->save($session)) {
                      //$this->Flash->success(__('The session has been saved.'));

                     // return $this->redirect(['action' => 'index']);
                  }
                 // $this->Flash->error(__('The session could not be saved. Please, try again.'));
              }
            }
         return $this->redirect(['action' => 'index']);
        }
        $AdminofTrainner = $this->Sessions->Users->find()
                                       ->select(['partner_id'])
                                       ->where(['id =' => $partner_id])->first();
//        $users = $this->Sessions->Users->find('list', ['limit' => 200]);
//        $partners = $this->Sessions->Partners->find('list', ['limit' => 200]);
        $this->set(compact('session', 'users', 'partners','user_type','users_id','partner_id','AdminofTrainner'));
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
        $new_id = '';
        $users_id = $this->usersdetail['users_id'];
        $user_type = $this->usersdetail['users_type'];
        $partner_id = $this->usersdetail['partner_id'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data1 =[];
            $data = $this->request->data;
    // pr($data); die;
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
        $AdminofTrainner = $this->Sessions->Users->find()
                                       ->select(['partner_id'])
                                       ->where(['id =' => $partner_id])->first();
    $this->set(compact('session', 'users', 'partners','user_type','session_values','new_id','users_id','partner_id','AdminofTrainner'));
        $this->set('_serialize', ['session']);
    }
    
    public function addMore($id = null){
         if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $session = $this->Sessions->get($id, [
            'contain' => []
        ]);
        $partner_id = $this->usersdetail['partner_id'];
        $users_id = $this->usersdetail['users_id'];
        $user_type = $this->usersdetail['users_type'];
        if ($this->request->is(['patch', 'post', 'put'])) {
           $data1 =[];
            $data = $this->request->data;
            $users = $this->request->data['user_id'];
        // pr($users); die;
            $dates = explode(',',substr($data['date'],0,-1));
            foreach($dates as $date) {
                foreach($users as $value)
                {

                   if($user_type != 3)
              {
                  $data1['partner_id'] = $this->usersdetail['users_id'];     
                  $data1['user_id'] = $value;     
              }   

                  //pr($data); die;
                      $data1['ex_detail'] = json_encode($data['excrcise']);
                      $data1['status'] = $data['status'];
                      $data1['date'] = $date;

                   //  pr($data1); die;
                  $sessione = $this->Sessions->newEntity();
                  $sessions  = $this->Sessions->patchEntity($sessione, $data1);
                 // pr($session); die;
                  if ($this->Sessions->save($sessions)) {
                      //$this->Flash->success(__('The session has been saved.'));

                     // return $this->redirect(['action' => 'index']);
                  }
                 // $this->Flash->error(__('The session could not be saved. Please, try again.'));
              }
            }
         return $this->redirect(['action' => 'index']);
        }
         $session_values = json_decode($session->ex_detail);
      $AdminofTrainner = $this->Sessions->Users->find()
                                       ->select(['partner_id'])
                                       ->where(['id =' => $partner_id])->first();
        $this->set(compact('session', 'users', 'partners','user_type','session_values','users_id','partner_id','AdminofTrainner'));
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
        $users_id = $this->usersdetail['users_id'];
        $user_type = $this->usersdetail['users_type'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data1 =[];
            $data = $this->request->data;
          //pr($data); die;
            $data1['user_detail'] = json_encode($data['userexcrcise']);
            $data1['user_date']   = date('Y-m-d');
            $data1['body_weight'] = $this->request->data('body_weight');
            $data1['hydration']   = $this->request->data('hydration');
            $data1['sleep']       = $this->request->data('sleep');
            $data1['notes']       = $this->request->data('notes');
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
        $this->set(compact('session', 'users', 'partners','user_type','session_values','users_id'));
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
