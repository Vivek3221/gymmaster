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
        $this->loadComponent('Common');
    }
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
       // $this->Users->userAuth = $this->UserAuth;
        $this->Auth->allow(['index','add','view','edit','login','status','adminLogin','verifiedUpdate','logout','payment','forgetPassword','forgotPassword','resetPassword']);
        
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
        $partner   ='';
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
        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['Users.partner_id'] = $partner;
        }
        
         if (isset($users_type) && ($users_type == 2)) {
          $search['Users.partner_id'] = $users_id;
          }
     //   pr($search);exit;
         if (isset($search)) {

            $count = $this->Users->find('all')
                    ->where([$search]);
        } else {
            $count = $this->Users->find('all');
        }

        $count = $count->where(['Users.active !=' => '3','Users.user_type !='=>'1']);

        $partners =  $this->Users->find('list')
                                 ->select(['id','name'])
                                ->where(['user_type'=> 2])
                                ->toArray();

//        pr($partners);exit;
        $this->paginate = ['limit' => $norec, 'order' => ['Users.id' => 'DESC']];

        $users = $this->paginate($count)->toArray();
       // $users = $this->paginate($this->Users);

        $this->set(compact('users', 'name', 'status', 'norec','email','user_type','users_type','partners','partner'));
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
        $this->PlanSubscribers    = TableRegistry::get('PlanSubscribers');
        $this->Payments    = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        // plans list
        $planData = [];
        $planSubscribers = $this->PlanSubscribers->find('all')
                ->where(['user_id'=>$id,'partner_id'=>$this->usersdetail['users_id']])
                ->order(['id DESC'])
                ->toArray();
        if(!empty($planSubscribers)) {
            $i=0;
            foreach ($planSubscribers as $plan) {
                $paidAmount = $this->Payments->find('all');
                $paidAmount =        $paidAmount->select(['sum' => $paidAmount->func()->sum('amount')])
                        ->where(['plan_subscriber_id'=>$plan->id])->first();
                $paid = 0;
                if(!empty($paidAmount->sum)) {
                    $paid = $paidAmount->sum;
                }
                $remaining = $plan->fee - $paid;
                $planData[$i]['name'] = $plan->plan_name;
                $planData[$i]['fee'] = $plan->fee;
                $planData[$i]['paid'] = $paid;
                $planData[$i]['remaining'] = $remaining;
                $planData[$i]['plan_expire_date'] = $plan->plan_expire_date;
                $planData[$i]['payment_due_date'] = $plan->payment_due_date;
                $i++;
            }
        }
            
        
        $this->set(compact('planData','user'));
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
      //pr($this->usersdetail);die;
        $users_type = $this->usersdetail['users_type'];
        $users_email = $this->usersdetail['users_email'];
        $users_name = $this->usersdetail['users_name'];
        $users_id   = $this->usersdetail['users_id'];
        $user       = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $t    = time();
            $name = $data['name'] . $t;
            if (isset($users_type) && ($users_type == 2)) {
                $data['user_type'] = '3';
            }
            $data['partner_id'] = $users_id;
            $data['username']   = $this->slugify($name);
            $data['guestid']    = $this->Cookie->read('guest_id');
            $data['verified']   = '1';
            $data['active']     = '2';
            // pr($data);exit;

            $user = $this->Users->patchEntity($user, $data);
            $useradd = $this->Users->save($user);
            if ($useradd) {

                $userDataArr['name']  = $data['name'];
                $userDataArr['email'] = $data['email'];
                $userDataArr['users_name'] = $users_name;
                $userDataArr['users_type'] = $users_type;
                $toEmail              = $data['email'];
                if($users_type == 1)
                {
                $subject              = 'Successfully Inquery | Datamonitoring';
              
                } else {
                 $subject              = 'Successfully Inquery | ' .$users_name;  
                }
                $email                = new Email();
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
        $this->PlanSubscribers = TableRegistry::get('PlanSubscribers');
        $this->Payments        = TableRegistry::get('Payments');
        $planSubscribers       = $this->PlanSubscribers->newEntity();
        $payments       = $this->Payments->newEntity();
        $plandata   =   $paymentdata = [];
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_name = $this->usersdetail['users_name'];
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            if(!empty($data['password'])) {    
                if ($data['password'] != $data['cpassword']) {
                    return $this->redirect(['action' => 'payment', $id]);
                }
                $data['password'] = md5($data['password']);
            }    
            if (isset($this->request->data['images']['name']) && $data['images']['name'] != "") {
                $flname = time() . str_replace(" ", "", $data['images']['name']);
                $flpath = WWW_ROOT . "img/" . $flname;
                if (move_uploaded_file($data['images']['tmp_name'], $flpath)) {
                    $data['photo'] = $flname;
                }
            }
            $user    = $this->Users->patchEntity($user, $data);
            $useradd = $this->Users->save($user);
            if ($useradd) {
                
                // insert into plan_subscribers
                $plandata['user_id']         = $user->id;
                $plandata['partner_id']      = $this->usersdetail['users_id'];
                $plandata['plan_name']       = $data['plan_name'];
                $plandata['fee']             = $data['fee'];
                $plandata['currency']        = 'INR';
                $plandata['plan_expire_date']= date('Y-m-d H:i:s',strtotime($data['plan_expire_date']));
                $plandata['payment_due_date']= date('Y-m-d H:i:s',strtotime($data['payment_due_date']));
                $planSubscribers             = $this->PlanSubscribers->patchEntity($planSubscribers, $plandata);
                $planSubscribersAdd = $this->PlanSubscribers->save($planSubscribers);
                
                // insert into payments
                $paymentdata['user_id']             = $user->id;
                $paymentdata['partner_id']          = $this->usersdetail['users_id'];
                $paymentdata['plan_subscriber_id']  = $planSubscribers->id;
                $paymentdata['amount']              = $data['amount'];
                $paymentdata['currency']            = 'INR';
                $payments    = $this->Payments->patchEntity($payments, $paymentdata);
                $payments->mode_ofpay = $data['mode_ofpay'];
                $paymentssAdd = $this->Payments->save($payments);
                if(!empty($data['password'])) {
                    $userDataArr['name']      = $data['name'];
                    $userDataArr['users_type']= $users_type;
                    $userDataArr['users_name']= $users_name;
                    $userDataArr['password']  = $data['cpassword'];
                    $userDataArr['email']     = $data['email'];
                    $userDataArr['planName']  = $data['plan_name'];
                    $userDataArr['expireDate']= date('d M Y',strtotime($data['plan_expire_date']));
                    $userDataArr['totalFee']  = $data['fee'];
                    $userDataArr['paidAmount']= $data['amount'];
                    $userDataArr['login_url'] = Router::url('/', ['controller' => 'Users', 'action' => 'login']);
                    $toEmail                  = $data['email'];
                     if($users_type == 1)
                {
                $subject              = 'Successfully Payment | Datamonitoring';
              
                } else {
                 $subject              = 'Successfully Payment | ' .$users_name;  
                }
                    $email                    = new Email();
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

                    }
                }    
                if(empty($data['password'])) {
                    $this->Flash->success(__('The plan has been saved.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                }elseif($useradd->user_type == 2){
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                }else {
                    $this->Flash->success(__('The user has been saved.'));
                   return $this->redirect(['controller' => 'FitnessMeserments', 'action' => 'add']);
                }
                
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
    
    /*
    *Login UI function
    */
    public function adminLogin() {
        $this->viewBuilder()->layout("ajax");
    }
      public function dashboard(){
             if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
          $uesrs                 = TableRegistry::get('Users');
          $users_count           = $uesrs->find()->select(['Users.id'])->where(['Users.active !=' => 2])->count();
//          pr($users_count);exit;
          $this->set(compact('users_count'));
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
                 return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
             } else {
                  return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
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
              $this->Auth->logout();
             return $this->redirect(['controller' => '/']);
 }
    
    /*
    *forgot password page
    */
    public function forgotPassword() {
        $this->viewBuilder()->layout("ajax");
    }   
    /*
     * forget password
     */
    public function forgetPassword() {
        $this->autoRender = false;
        // check email is registered with us
        //$users_type = $this->usersdetail['users_type'];
        //$users_name = $this->usersdetail['users_name'];
        $userData = $this->Users->find()->select(['id','name'])->where(['email' => $this->request->data['email']]);
//        pr($userData); die;
        if($userData->count()) {
            // token and url generate
            $userData = $userData->first();
            $userid = $userData->id;
            $useremail = $this->request->data['email'];
            $tokenString = json_encode(['id'=>$userid, 'email'=>$useremail, 'uid'=>time()]);
            $token = $this->Common->base64url_encode($tokenString);
            $postData = $this->request->data;
            $postData['user_id'] = $userid;
            $postData['token'] = $token;
            $postData['status'] = 1;
            $insertRequest = $this->Common->createToken($postData);
            if(!empty($insertRequest)) {
                $subject = 'Reset password link';
                $verifylink = SITE_URL.'reset-password/'.$token;
                $userDataArr['name']  = $userData->name;
                $userDataArr['link']  = $verifylink;
               // $userDataArr['users_type']= $users_type;
                //$userDataArr['users_name']= $users_name;
                $email      = new Email();
                $email->transport('default');
                try {
                    $email->emailFormat('html');
                    $email->template('forgetPassword')
                            ->from(['support@datamonitering.com' => 'Datamonitoring'])
                            ->to($useremail)
                            ->subject($subject)
                            ->viewVars($userDataArr)
                            ->send();
                } catch (Exception $e) {
                    
                }
                $result = ['msg_type' => 'success', 'msg' => 'Reset password link sent on your registered email.'];
            } else {
                $result = ['msg_type' => 'fail', 'msg' => 'Some error, please try again.'];
            }
        } else {
            $result = ['msg_type' => 'fail', 'msg' => 'This email is not registered with us.'];
        }
        
        echo json_encode($result);
        exit();
    }
    
    /*
     * forget password
     */
    public function resetPassword($token) {
        $this->viewBuilder()->layout("ajax");
        $this->Tokens    = TableRegistry::get('Tokens');
        if(!empty($token)) {
            $tokenString = $this->Common->base64url_decode($token);
            $tokenArray  = json_decode($tokenString, true);
            //step-1 check token is valid and not expired
            $tokenData    = $this->Tokens->find()->select(['token'])
                                ->where(['token' => $token,'user_id'=>$tokenArray['id'], 'email'=>$tokenArray['email'], 'created >=' => date('Y-m-d H:i:s', strtotime('-1 Hour'))])
                                ->order(['id DESC'])->first();
            if(!empty($tokenData)) {
                //if post 
                if ($this->request->is('post')) {
                    $postData = $this->request->data;
                    // check password and confirm password are same
                    if($postData['newpassword'] == $postData['confirmpassword'] && !empty($postData['newpassword'])) {
                        // update password in users table
                        $user = $this->Users->get($tokenArray['id']);
                        $data['password'] = md5($postData['newpassword']);
                        $user    = $this->Users->patchEntity($user, $data);
                        $useradd = $this->Users->save($user);
                        if ($useradd) {
                            // redirect to login page
                            $this->Flash->error(__('Password is updated successfully.'));
                            return $this->redirect(['controller' => 'Users', 'action' => 'adminLogin']);
                        } else {
                            $this->Flash->error(__('Some error in updating password.'));
                        }
                    } else {
                        $this->Flash->error(__('New password and comfirm password are not same.'));
                    }
                }
            } else {
                $this->Flash->error(__('Invalid/expired Url.'));
            }
        } else {
            $this->Flash->error(__('Invalid Url.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'adminLogin']);
        }
        
        $this->set(compact('token'));
    }
    
    /*
     * Add payments for user's plan
     */
    public function addPayment($userid){
        $this->Payments    = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $search = [];
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['partner_id'] = $this->usersdetail['users_id'];
            $data['currency'] = 'INR';
            $payment = $this->Payments->patchEntity($payment, $data);
            $payment->mode_ofpay = $data['mode_ofpay'];
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        
        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        if (!empty($search)) {
            $users = $this->Payments->Users->find(['list','contain' => ['Users', 'Partners']])
                    ->where([$search]);
        } else {
            $users = $this->Payments->Users->find(['list','contain' => ['Users', 'Partners']]);
        }
        
        $partners = $this->Payments->Partners->find('list');
        $planSubscribers = $this->Payments->PlanSubscribers->find('list')
                ->where(['user_id'=>$userid,'partner_id'=>$this->usersdetail['users_id']]);
        $this->set(compact('payment', 'users', 'partners', 'planSubscribers','userid'));
    }

    /*
     * show plan list select inout using ajax
     */
    public function showPlanList($userid) {
        $this->viewBuilder()->layout("ajax");
        $this->Payments    = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $planSubscribers = $this->Payments->PlanSubscribers->find('list', ['limit' => 200])
                ->where(['user_id'=>$userid,'partner_id'=>$this->usersdetail['users_id']]);
        $this->set(compact('planSubscribers','userid'));
    }

    /*
     * show plan list select inout using ajax
     */
    public function showPlanDetails($planid) {
        $this->viewBuilder()->layout("ajax");
        $this->Payments    = TableRegistry::get('Payments');
        $this->PlanSubscribers    = TableRegistry::get('PlanSubscribers');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $planSubscribers = $this->PlanSubscribers->find('all')
                ->select(['id','fee','payment_due_date','plan_expire_date'])
                ->where(['id'=>$planid])->first();
        $paidAmount = $this->Payments->find('all');
        $paidAmount =        $paidAmount->select(['sum' => $paidAmount->func()->sum('amount')])
                ->where(['plan_subscriber_id'=>$planSubscribers->id])->first();
        $paid = 0;
        if(!empty($paidAmount->sum)) {
            $paid = $paidAmount->sum;
        }
        $remaining = $planSubscribers->fee - $paid;
        if(!empty($this->request->query('amount'))){
            $updateLimit = $remaining + $this->request->query('amount');
            $paid = $paid - $this->request->query('amount');
            $remaining = $remaining + $this->request->query('amount');
        }
        echo '<div class="col-sm-12"><strong>Selected Plan Details:</strong></div>';
        echo '<div class="col-sm-4"><strong>Total Fee:</strong> INR '.$planSubscribers->fee.'</div>';
        echo '<div class="col-sm-4"><strong>Paid Amount:</strong> INR '.$paid.'</div>';
        echo '<div class="col-sm-4"><strong>Remaining Amount:</strong> INR '.$remaining.'</div>';
        echo ' <input type="hidden" id="fee" name="fee" value="'.$remaining.'">';
        echo '<div class="col-sm-4"><strong>Payment Due Date:</strong> '.date('d-m-Y',strtotime($planSubscribers->payment_due_date)).'</div>';
        echo '<div class="col-sm-4"><strong>Plan Expire Date:</strong> '.date('d-m-Y',strtotime($planSubscribers->plan_expire_date)).'</div>';
        exit;
    }


    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
