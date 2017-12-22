<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Http\Client;
use Cake\Mailer\Email;
use Cake\Core\Plugin;
use Cake\Filesystem\Folder;
use Cake\Routing\Router;
use Cake\Utility\Security;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    
    public function initialize()
    {

        parent::initialize();
        $this->loadComponent('Flash'); 
    }
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
       // $this->Users->userAuth = $this->UserAuth;
        $this->Auth->allow(['dashboardPartner','index','changePassword','add','view','edit','login','status','adminLogin','verifiedUpdate','forgotPassword','resetPassword','profileEdit','getNewArtiCount','getLangCount','getNewweakCount','getArtiweakCount']);
        
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        
       // pr($this->Cookie->read('user_email')); die;
        
        $name = '';
        $email = '';
        $norec = 10;
        $status = '';
        $search = [];
        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Users.name REGEXP'] = $name;
        }
        
         if (isset($this->request->query['email']) && trim($this->request->query['email']) != "") {
            $email = $this->request->query['email'];
            $search['Users.email REGEXP'] = $email;
        }

        if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['Users.active'] = $status;
        }

        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        
         if (isset($search)) {

            $count = $this->Users->find('all')
                    ->where([$search]);
        } else {
            $count = $this->Users->find('all');
        }

        $count = $count->where(['Users.active !=' => '2']);




        $this->paginate = ['limit' => $norec, 'order' => ['Users.id' => 'DESC']];

        $users = $this->paginate($count)->toArray();

        
        
        
        
       // $users = $this->paginate($this->Users);

        $this->set(compact('users', 'name', 'status', 'norec','email'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            
            $data = $this->request->data;
           
            $t = time();
            $name = $data['name'] . $t;

            $data['username'] = $this->slugify($name);
            $data['guestid'] = '11';
            $data['verified'] = '1';
//             pr($data);exit;
            if($data['password'] != $data['cpassword'])
            {
                $this->Flash->error(__('Password Not Match .'));
              return $this->redirect(['action' => 'add']);
            }
            
            $data['password'] = md5($data['cpassword']);
            
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                
           $userDataArr['Password']  = $data['cpassword'];
           $userDataArr['name']      = $data['name'];
           $userDataArr['email']     = $data['email'];
            $toEmail                 = $data['email'];
            $subject                 = 'Registration Successful | Gym-Admin';
            $email                   = new Email();
            $email->transport('default');
            try {
                $email->emailFormat('html');
                $email->template('userpass')
                        ->from(['noreply@gymadmin.com' => 'Gym-Admin'])
                        ->to($toEmail)
                        ->subject($subject)
                        ->viewVars($userDataArr)
                        ->send();
            } catch (Exception $e) {

            }$this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['guestid'] = '11';
          //  $data['location'] = $data['location'];
           // pr($data);
            
            $user = $this->Users->patchEntity($user, $data);
        //   pr($user); die;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        //pr($user); die;
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    
     public function verifiedUpdate() {
        $this->autoRender = false;
        $get_id = $this->request->data['id'];

        $verified = $this->request->data['verified'];


        if ($verified == '1') {
            $verified_chg = '0';
        } else {
            $verified_chg = '1';
        }
        $query = $this->Users->query();
        $result = $query->update()
                ->set(['verified' => $verified_chg])
                ->where(['id' => $get_id])
                ->execute();
        $user = $this->Users->find()
                ->select(['email','name'])
                ->where(['id' => $get_id])
                ->first();
   
        if ($verified_chg == '0') {

            echo '<button id=' . $get_id . ' class="btn btn-primary waves-effect" value=' . $verified_chg . ' onclick="updateVerified(this.id,' . $verified_chg . ')" type="submit">UnApproved</button>';
        } else {

            
             

            echo '<button id=' . $get_id . ' class="btn btn-success waves-effect" value=' . $verified_chg . ' onclick="updateVerified(this.id,' . $verified_chg . ')" type="submit">Approved</button>';
     }
    }
    
    
       public function status() {
        $id = $this->request->params['pass'][0];
        $status = $this->request->params['pass'][1];
        $user = $this->Users->get($id);
        if ($status == 1) {
            $user_data['active'] = 0;
            $user_data['id'] = $id;
            $user = $this->Users->patchEntity($user, $user_data);
            if ($this->Users->save($user)) {
                $st = $user_data['active'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                // echo "<a href= '#' onclick = 'updateStatus(" . $id . "," . $user_data['status'] . ")'> " . $st . " </a>";
                echo '<button id=' . $id . ' class="btn btn-primary waves-effect status" value=' . $user_data['active'] . ' onclick="updateStatus(this.id,' . $user_data['active'] . ')" type="submit">Inactive</button>';
                exit;
            }
        } else {
            $user_data['active'] = 1;
            $user_data['id'] = $id;
            $user = $this->Users->patchEntity($user, $user_data);
            if ($this->Users->save($user)) {
                $st = $user_data['active'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                echo '<button id=' . $id . ' class="btn btn-success waves-effect status" value=' . $user_data['active'] . ' onclick="updateStatus(this.id,' . $user_data['active'] . ')" type="submit">Active</button>';
                exit;
            }
        }
    }
    
     public function adminLogin()
      {
     
       }
      
       
       
        public function login()
    {
         
        $user = $this->Users->newEntity();
        
        if ($this->request->is('post')) {
            //echo 'ggg';
               $data = $this->request->data;
               
               $data['password'] = md5($this->request->data['password']);
               $data['email'] = $this->request->data['email'];
               
              // pr($data); die;
               $count = $this->Users->find()->select(['id'])->where(['email' => $data['email'], 'password' =>$data['password'], 'active'=>1])->count();
              
               if($count == 1)
               {
                    $user_detail = $this->Users->find()->select(['id','user_type','name','email'])->where(['email' => $data['email'], 'active' => 1])->first();
                 
                    $this->request->session()->write('users_id', $user_detail->id);
                     $this->Cookie->write('users_name', $user_detail->name);
                    $this->Cookie->write('users_id', $user_detail->id);
                    $this->Cookie->write('user_email', $user_detail->email);
                    $this->Cookie->write('user_type', $user_detail->user_type);
                   
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
               }
            else {
                $this->Flash->error(__('This email and password not match'));
                 return $this->redirect(['controller' => 'Users', 'action' => 'adminLogin']);
               }
               
    }
               //pr($data); die;
           
            
        }
        
        
         public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
       
    
    

    
    
     public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
