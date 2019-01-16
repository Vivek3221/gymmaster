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
          if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        
        $user_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        $name = '';
        $sdate ='';
        $edate ='';
        $norec = 20;
        $status = '';
        $partner = '';
        $search = [];
         if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Diets.user_id'] = $name;
        }
        //Diets=notedit
         if (isset($this->request->query['Diets']) && trim($this->request->query['Diets']) != "") {
            $Diets_value = $this->request->query['Diets'];
            //$search['Diets.user_id'] = $name;
        }
         if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['Diets.partner_id'] = $partner;
        }
         if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['Diets.status'] = $status;
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        if (isset($this->request->query['from_date']) && trim($this->request->query['from_date']) != "" && isset($this->request->query['to_date']) && trim($this->request->query['to_date']) != "" ) {
          
            $sdate = date('Y-m-d H:i:s',strtotime($this->request->query['from_date'])); 
            $edate = date('Y-m-d H:i:s',strtotime($this->request->query['to_date'])) ;

            $search['Diets.date >='] = $sdate;
            $search['Diets.date <='] = $edate;  
            $sdate = $this->request->query['from_date']; 
            $edate = $this->request->query['to_date'] ;

             
        }
        
        
        if (isset($user_type) && ($user_type == 3)) {
          $search['Diets.user_id'] = $users_id;
          }
        if (isset($user_type) && ($user_type == 2)) {
          $search['Users.partner_id'] = $users_id;
          }
        if (isset($user_type) && ($user_type == 4)) {
          $search['Users.trainer_userid'] = $users_id;
          }  
        if (!empty($search)) {
            $count = $this->Diets->find('all')
                    ->where([$search])
                     ->order(['date' => 'DESC']);
        } else {
            $count = $this->Diets->find('all');
        }
        if (isset($user_type) && ($user_type == 3)) {
        $count = $count->where(['Diets.status ' => '1' ,'Diets.date <=' => date('Y-m-d')]);
        } else {
             $count = $count->where(['Diets.status !=' => '2']);
        }
        if(isset($Diets_value) && !empty($Diets_value))
        {
           $count = $count->where(['date <' => date('Y-m-d') ,'user_detail Is Null']);  
        }
        $this->paginate = [
            'contain' => ['Users'],
            'limit' => $norec, 
            'order' => ['Diets.id' => 'DESC'],
            
        ];
        
       
        $diets = $this->paginate($count);
        if($user_type == 4){
         $users = $this->Diets->Users->find('list')->where(['Users.active' => '1' ,'Users.trainer_userid'=> $users_id,'user_type' =>3]);
            }else{
           $users = $this->Diets->Users->find('list')->where(['Users.active' => '1' ,'Users.partner_id'=> $users_id,'user_type' =>3]);
        }
       

       // $partners = $this->Diets->Users->find('list')->where(['Users.active' => '1' ,'Users.partner_id'=> $users_id,'user_type' =>2]);
        $this->set(compact('diets','name','status','norec','users','user_type','sdate','edate','partner'));
        $this->set('_serialize', ['Diets']);
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
          if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
           $users_id = $this->usersdetail['users_id'];
        $diet = $this->Diets->get($id, [
            'contain' => ['Users']
        ]);
   
      $diet_values = json_decode($diet->diet_details);
//pr($session_values);
      $user_values = json_decode($diet->user_detail);
//pr($user_values); die;

        $this->set(compact('diet', 'user_values', 'partners','user_type','diet_values','users_id'));
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
        $user_type  = $this->usersdetail['users_type'];
        $partner_id = $this->usersdetail['partner_id'];
        $users_id   = $this->usersdetail['users_id'];
        $diet    = $this->Diets->newEntity();
        if ($this->request->is('post')) 
          {
            $datas =[];
            $data  = $this->request->data;
            $users = $this->request->data['user_id'];
            $dates = explode(',',substr($data['date'],0,-1));
            foreach($dates as $date) 
            {
                foreach($users as $value)
                {
                   if($user_type != 3)
                 {
                  $datas['partner_id'] = $this->usersdetail['users_id'];     
                  $datas['user_id'] = $value;     
                 }   
                      $datas['diet_details']       = json_encode($data['excrcise']);
                      $datas['status']             = $data['status'];
                      // $datas['diet_type']       = $data['diet_type'];
                      $datas['date']               = $date;

                  //$diets = $this->Diets->newEntity();
                  $diet    = $this->Diets->newEntity();
                  $diets   = $this->Diets->patchEntity($diet, $datas);

                 
                  if ($this->Diets->save($diets)) {
                      // $this->Flash->success(__('The diet has been created.'));

                     // return $this->redirect(['action' => 'index']);
                  }
                 // $this->Flash->error(__('The diet could not be saved. Please, try again.'));
              }
            }
         return $this->redirect(['action' => 'index']);
        }
        $AdminofTrainner = $this->Diets->Users->find()
                                       ->select(['partner_id'])
                                       ->where(['id =' => $partner_id])->first();
        $this->set(compact('diet', 'users', 'partners','user_type','users_id','partner_id','AdminofTrainner'));
        $this->set('_serialize', ['diet']);
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
          if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $diet = $this->Diets->get($id, [
            'contain' => []
        ]);
        $new_id = '';
        $users_id = $this->usersdetail['users_id'];
        $user_type = $this->usersdetail['users_type'];
        $partner_id = $this->usersdetail['partner_id'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $datas =[];
            $data = $this->request->data;
    // pr($data); die;
             if($user_type != 3)
        {
            $datas['partner_id'] = $this->usersdetail['users_id'];     
            $datas['user_id'] = $this->request->data['user_id'];     
        }     
                $datas['diet_details']      = json_encode($data['excrcise']);
                $datas['status']          = $data['status'];
                // $datas['diet_type']    = $data['diet_type'];
                $datas['date']            = $data['date'];
                
             //  pr($datas); die;
            $diet = $this->Diets->patchEntity($diet, $datas);
            if ($this->Diets->save($diet)) {
                $this->Flash->success(__('The diet has been edited.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diet could not be saved. Please, try again.'));
        }
         //pr($diet->diet_details); die;
         $diet_values = json_decode($diet->diet_details);
      // pr($diet_values); die;
        $AdminofTrainner = $this->Diets->Users->find()
                                       ->select(['partner_id'])
                                       ->where(['id =' => $partner_id])->first();
    $this->set(compact('diet', 'users', 'partners','user_type','diet_values','new_id','users_id','partner_id','AdminofTrainner'));
        $this->set('_serialize', ['diet']);
    }
    
    public function addMore($id = null){
         if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $diet = $this->Diets->get($id, [
            'contain' => []
        ]);
        $new_id = '';
        $partner_id = $this->usersdetail['partner_id'];
        $users_id = $this->usersdetail['users_id'];
        $user_type = $this->usersdetail['users_type'];
        if ($this->request->is(['patch', 'post', 'put'])) {
           $datas =[];
            $data = $this->request->data;
            $users = $this->request->data['user_id'];
       
            $dates = explode(',',substr($data['date'],0,-1));
             // pr($users); die;
            foreach($dates as $date) {
                foreach($users as $value)
                {

                   if($user_type != 3)
              {
                  $datas['partner_id'] = $this->usersdetail['users_id'];     
                  $datas['user_id'] = $value;     
              }   
                      $datas['diet_details']       = json_encode($data['excrcise']);
                      $datas['status']             = $data['status'];
                      // $datas['diet_type']    = $data['diet_type'];
                      $datas['date']               = $date;

                   //  pr($datas); die;
                  $diete = $this->Diets->newEntity();
                  $Diets  = $this->Diets->patchEntity($diete, $datas);
                 // pr($Diets); die;
                  if ($this->Diets->save($Diets)) {
                      //$this->Flash->success(__('The diet has been saved.'));

                     // return $this->redirect(['action' => 'index']);
                  }
                 // $this->Flash->error(__('The diet could not be saved. Please, try again.'));
              }
            }
         return $this->redirect(['action' => 'index']);
        }
         $diet_values = json_decode($diet->diet_details);
      $AdminofTrainner = $this->Diets->Users->find()
                                       ->select(['partner_id'])
                                       ->where(['id =' => $partner_id])->first();
        $this->set(compact('diet', 'users', 'partners','user_type','diet_values','users_id','partner_id','AdminofTrainner','new_id'));
        $this->set('_serialize', ['diet']);
    }
    
  public function userEdit($id = null)
    {
      //  echo 'ffffffff'; die;
          if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $diets = $this->Diets->get($id, [
            'contain' => []
        ]);
        $users_id = $this->usersdetail['users_id'];
        $user_type = $this->usersdetail['users_type'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $datas =[];
            $data = $this->request->data;
       //   pr($data); die;
            $datas['user_detail'] = json_encode($data['userexcrcise']);
            $datas['user_date']   = date('Y-m-d');
          //  $datas['body_weight'] = $this->request->data('body_weight');
          //  $datas['hydration']   = $this->request->data('hydration');
           // $datas['sleep']       = $this->request->data('sleep');
//           $datas['notes']       = $this->request->data('notes');
             //  pr($datas); die;
            $userdiet = $this->Diets->patchEntity($diets, $datas);
           // pr($userdiet); die;
            if ($this->Diets->save($userdiet)) {
                $this->Flash->success(__('The Diet has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The Diet could not be saved. Please, try again.'));
        }
         $diets_values = json_decode($diets->diet_details);
         $diets_user_values = json_decode($diets->user_detail);
         if(isset($diets_user_values) && !empty($diets_user_values))
         {
            $users_diet_values = $diets_user_values;
         }else
         {
          $users_diet_values =   $diets_values;
         }
      // pr($session_values); die;
        //$users = $this->Sessions->Users->find('list', ['limit' => 200]);
       // $partners = $this->Sessions->Partners->find('list', ['limit' => 200]);
        $this->set(compact('diets', 'users', 'partners','user_type','diets_values','users_id','users_diet_values'));
        $this->set('_serialize', ['session']);
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

     public function status() {
                       if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $id     = $this->request->params['pass'][0];
        $status = $this->request->params['pass'][1];
        $user   = $this->Diets->get($id);
        if ($status == 1) {
            $user_data['status'] = 0;
            $user_data['id'] = $id;
            $user = $this->Diets->patchEntity($user, $user_data);
            if ($this->Diets->save($user)) {
                $st = $user_data['status'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                // echo "<a href= '#' onclick = 'updateStatus(" . $id . "," . $user_data['status'] . ")'> " . $st . " </a>";
                echo '<button id=' . $id . ' class="btn btn-primary waves-effect status" value=' . $user_data['status'] . ' onclick="updateStatus(this.id,' . $user_data['status'] . ')" type="submit">Inactive</button>';
                exit;
            }
        } else {
            $user_data['status'] = 1;
            $user_data['id'] = $id;
            $user = $this->Diets->patchEntity($user, $user_data);
            if ($this->Diets->save($user)) {
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
