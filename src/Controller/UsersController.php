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
        $this->Auth->allow(['index','add','view','edit','login','status','adminLogin','verifiedUpdate','logout','payment']);
        
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        
       //pr($this->usersdetail['users_email']); die;
                      if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $name = '';
        $email = '';
        $norec = 10;
        $status = '';
        $user_type = '';
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        
        
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
        if (isset($this->request->query['user_type']) && trim($this->request->query['user_type']) != "") {
            $user_type = $this->request->query['user_type'];
            $search['Users.user_type'] = $user_type;
        }
        
         if (isset($users_type) && ($users_type == 2)) {
          $search['Users.partner_id'] = $users_id;
          }
        
         if (isset($search)) {

            $count = $this->Users->find('all')
                    ->where([$search]);
        } else {
            $count = $this->Users->find('all');
        }

        $count = $count->where(['Users.active !=' => '3','Users.user_type !='=>'1']);




        $this->paginate = ['limit' => $norec, 'order' => ['Users.id' => 'DESC']];

        $users = $this->paginate($count)->toArray();

        
        
        
        
       // $users = $this->paginate($this->Users);

        $this->set(compact('users', 'name', 'status', 'norec','email','user_type','users_type'));
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
                       if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
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
    public function add() {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
       // pr($this->usersdetail);die;
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;
            //pr($users_type);
           // pr($data); die;
            
            $t = time();
            $name = $data['name'] . $t;
          if (isset($users_type) && ($users_type == 2)) {
          $data['user_type'] = '3';
          $data['partner_id'] = $users_id;
          }

            $data['username'] = $this->slugify($name);
            $data['guestid'] = $this->Cookie->read('guest_id');
            $data['verified'] = '1';
            $data['active'] = '2';
            // pr($data);exit;

            $user = $this->Users->patchEntity($user, $data);
            $useradd = $this->Users->save($user);
            if ($useradd) {

//                if (isset($users_type) && ($users_type == 2)) {
//                    $this->Partners = TableRegistry::get('Partners');
//                    $partner = $this->Partners->newEntity();
//                    $data1['user_id'] = $users_id;
//                    $partner = $this->Partners->patchEntity($partner, $data1);
//                    $partner_add = $this->Partners->save($partner);
//                    if ($partner_add) {
//                        $userUpdate = $this->Users->get($useradd->id);
//                        $userData['partner_id'] = $partner_add->id;
//                        $userUpdate = $this->Users->patchEntity($userUpdate, $userData);
//                        $this->Users->save($userUpdate);
//                    }
//                }

                $userDataArr['name'] = $data['name'];
                $userDataArr['email'] = $data['email'];
                $toEmail = $data['email'];
                $subject = 'Inquery Successful | Datamonitoring';
                $email = new Email();
                $email->transport('default');
                try {
                    $email->emailFormat('html');
                    $email->template('inquery')
                            ->from(['support@datamonitering.com' => 'Datamonitoring'])
                            ->to($toEmail)
                            ->subject($subject)
                            ->viewVars($userDataArr)
                            ->send();
                } catch (Exception $e) {
                    
                }$this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'payment', $useradd->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'users_type'));
        $this->set('_serialize', ['user']);
    }

    public function payment($id = '') {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->data;
            if ($data['password'] != $data['cpassword']) {
                return $this->redirect(['action' => 'payment', $id]);
            }
            $data['password'] = md5($data['password']);

            if (isset($this->request->data['images']['name']) && $data['images']['name'] != "") {
                $flname = time() . str_replace(" ", "", $data['images']['name']);
                $flpath = WWW_ROOT . "img/" . $flname;
                if (move_uploaded_file($data['images']['tmp_name'], $flpath)) {
                    $data['photo'] = $flname;
                }
            }

            //pr($data); die;
            $user = $this->Users->patchEntity($user, $data);

            // pr($user); die;
            $useradd = $this->Users->save($user);
            if ($useradd) {

                $userDataArr['name'] = $data['name'];
                $userDataArr['password'] = $data['cpassword'];
                $userDataArr['email'] = $data['email'];
                $userDataArr['login_url'] = Router::url('/', ['controller' => 'Users', 'action' => 'login']);
                $toEmail = $data['email'];
                $subject = 'Inquery Successful | Gym-Admin';
                $email = new Email();
                $email->transport('default');
                try {
                    $email->emailFormat('html');
                    $email->template('userpass')
                            ->from(['support@datamonitering.com' => 'Datamonitoring'])
                            ->to($toEmail)
                            ->subject($subject)
                            ->viewVars($userDataArr)
                            ->send();
                } catch (Exception $e) {
                    
                }$this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['controller'=>'FitnessMeserments', 'action' => 'add']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $user_id = $id;
        $this->set(compact('user_id', 'user'));
        $this->set('_serialize', ['user_id', 'user']);
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
     if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
      return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
           // $data['guestid'] = '11';
            
           if (isset($this->request->data['images']['name']) && $data['images']['name'] != "") {
                $flname = time() . str_replace(" ", "", $data['images']['name']);
                $flpath = WWW_ROOT . "img/" . $flname;
                if (move_uploaded_file($data['images']['tmp_name'], $flpath)) {
                    $data['photo'] = $flname;
                }
            }
          //  pr($data); die;
            $user = $this->Users->patchEntity($user, $data);
        //   pr($user); die;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        //pr($user); die;
        $this->set(compact('user','users_type'));
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
       if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
       return $this->redirect('/');
        }
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
                      if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
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
                       if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
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
               
               
               $count = $this->Users->find()->select(['id'])->where(['email' => $data['email'], 'password' =>$data['password'], 'active'=>1])->count();
              //pr($count); die;
               if($count == 1)
               {
                    $this->Cookie->write('user_email', $data['email']);
                    $this->request->session()->write('Auth.User.email', $data['email']);
                    
                    $user_detail = $this->Users->find()->select(['id','user_type','name','email','partner_id'])->where(['email' => $data['email'], 'active' => 1])->first();
                    $this->Cookie->write('users',['users_id'=>$user_detail->id,'users_name'=>$user_detail->name,'users_email'=>$user_detail->email,'users_type' =>$user_detail->user_type,'partner_id' =>$user_detail->partner_id]);
                    $this->request->session()->write('users',['users_id'=>$user_detail->id,'users_name'=>$user_detail->name,'users_email'=>$user_detail->email,'users_type' =>$user_detail->user_type,'partner_id' =>$user_detail->partner_id]);
             if($user_detail->user_type == 3){
                 return $this->redirect(['controller' => 'FitnessMeserments', 'action' => 'index']);
             } else {
                  return $this->redirect(['controller' => 'Users', 'action' => 'index']);
             }
               }
            else {
                $this->Flash->error(__('This email and password not match'));
                 return $this->redirect(['controller' => 'Users', 'action' => 'adminLogin']);
               }
    }
        }
        
        
         public function logout()
    {
             $this->autoRender = false;
             $this->Cookie->delete('users');
             return $this->redirect(['controller' => '/']);
 }
       
    
    

    
    
     public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
