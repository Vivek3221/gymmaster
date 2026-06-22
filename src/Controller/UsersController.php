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

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // $this->Users->userAuth = $this->UserAuth;
        $this->Auth->allow(['index', 'add', 'view', 'edit', 'login', 'status', 'adminLogin', 'verifiedUpdate', 'logout', 'payment', 'forgetPassword', 'forgotPassword', 'resetPassword', 'siteMap', 'about', 'contact', 'sendContact', 'userProfile', 'saveRemark', 'getRemarks']);
    }

    public function about()
    {
        // Auto renders about.ctp
    }

    public function contact()
    {
        // Auto renders contact.ctp
    }

    /**
     * Handle contact form submission via AJAX.
     * Sends details to makeover72@gmail.com via SMTP.
     */
    public function sendContact()
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post']);

        // Read directly from $_POST — most reliable for multipart/form-data AJAX
        $senderName   = isset($_POST['name'])    ? trim($_POST['name'])    : '';
        $senderEmail  = isset($_POST['email'])   ? trim($_POST['email'])   : '';
        $senderPhone  = isset($_POST['phone'])   ? trim($_POST['phone'])   : '';
        $senderMessage = isset($_POST['message']) ? trim($_POST['message']) : '';

        // Basic validation
        if (empty($senderName) || empty($senderEmail) || empty($senderMessage)) {
            echo json_encode(['success' => false, 'msg' => 'Please fill in all required fields.']);
            exit();
        }
        if (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'msg' => 'Please enter a valid email address.']);
            exit();
        }

        $toEmail = 'makeover72@gmail.com';
        $subject = 'New Contact Enquiry from ' . $senderName . ' | MakeOver Star HIIT';

        $viewVars = [
            'senderName'    => $senderName,
            'senderEmail'   => $senderEmail,
            'senderPhone'   => $senderPhone,
            'senderMessage' => $senderMessage,
        ];

        try {
            $email = new Email();
            $email->transport('default');
            $email->emailFormat('html')
                ->template('contact_inquiry')
                ->from(['support@datamonitering.com' => 'MakeOver Star HIIT'])
                ->to($toEmail)
                //   ->cc('singhabhi841417@gmail.com')
                ->subject($subject)
                ->viewVars($viewVars)
                ->send();

            echo json_encode(['success' => true, 'msg' => 'Your message has been sent successfully! We will get back to you soon.']);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'msg' => 'Failed to send message. Please try again or contact us directly.']);
        }
        exit();
    }

    public function userProfile()
    {
        if (empty($this->usersdetail['users_id'])) {
            return $this->redirect('/');
        }
        $userId = $this->usersdetail['users_id'];
        $Users  = TableRegistry::get('Users');
        $user   = $Users->get($userId);

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->data;

            // Update name
            if (!empty($data['users_name'])) {
                $user->name = trim($data['users_name']);
            }

            // Update password only if provided
            if (!empty($data['new_password'])) {
                if ($data['new_password'] !== $data['confirm_password']) {
                    $this->Flash->error('Passwords do not match.');
                    $this->set(compact('user'));
                    return;
                }
                $user->password = md5($data['new_password']);
            }

            if ($Users->save($user)) {
                // Refresh session with updated name
                $session = $this->request->session()->read('users');
                $session['users_name'] = $user->name;
                $this->request->session()->write('users', $session);
                $this->Cookie->write('users', $session);
                $this->Flash->success('Profile updated successfully!');
                return $this->redirect(['action' => 'userProfile']);
            } else {
                $this->Flash->error('Could not update profile. Please try again.');
            }
        }

        $this->set(compact('user'));
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
        $norec = 20;
        $status = '';
        $user_type = '';
        $partner   = '';
        $trainer   = '';
        $start_date = '';
        $end_date = '';
        $date_type = 'reg';
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

        if (isset($this->request->query['status'])) {
            $status = $this->request->query['status'];
            if (trim($status) !== "") {
                $search['Users.active'] = $status;
            }
        } else {
            $status = '';
        }

        if (isset($this->request->query['date_type']) && trim($this->request->query['date_type']) != "") {
            $date_type = $this->request->query['date_type'];
        }

        if (isset($this->request->query['start_date']) && trim($this->request->query['start_date']) != "") {
            $start_date = $this->request->query['start_date'];
        }

        if (isset($this->request->query['end_date']) && trim($this->request->query['end_date']) != "") {
            $end_date = $this->request->query['end_date'];
        }

        if ($date_type !== 'followup') {
            if (!empty($start_date)) {
                $search['Users.created >='] = $start_date . ' 00:00:00';
            }
            if (!empty($end_date)) {
                $search['Users.created <='] = $end_date . ' 23:59:59';
            }
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

        if (isset($this->request->query['trainers']) && trim($this->request->query['trainers']) != "") {
            $trainer = $this->request->query['trainers'];
            $search['Users.trainer_userid'] = $trainer;
        }
        if (isset($this->request->query['users']) && trim($this->request->query['users']) != "") {
            $news_user = date('Y-m-d');
            $search['Users.dob ='] = $news_user;
        }

        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        //   pr($search);exit;
        $search['Users.user_type !='] = 4;
        if (isset($search)) {

            $count = $this->Users->find('all')
                ->where([$search]);
        } else {
            $count = $this->Users->find('all');
        }

        $count = $count->where(['Users.active !=' => '3', 'Users.user_type !=' => '1']);

        if ($date_type === 'followup') {
            if (!empty($start_date) || !empty($end_date)) {
                $count = $count->where(function ($exp) use ($start_date, $end_date) {
                    $userRemarksTable = TableRegistry::get('UserRemarks');
                    $subquery = $userRemarksTable->find()
                        ->select(['user_id'])
                        ->where(['UserRemarks.user_id = Users.id']);

                    if (!empty($start_date)) {
                        $subquery->where(['UserRemarks.created >=' => $start_date . ' 00:00:00']);
                    }
                    if (!empty($end_date)) {
                        $subquery->where(['UserRemarks.created <=' => $end_date . ' 23:59:59']);
                    }

                    return $exp->exists($subquery);
                });
            }
        }

        $partners =  $this->Users->find('list')
            ->select(['id', 'name'])
            ->where(['user_type' => 2])
            ->toArray();

        // --- Tab counts: All, Active, Inactive, Enquiry ---
        $baseCountConditions = ['Users.user_type NOT IN' => ['1', '4'], 'Users.active !=' => '3'];
        if (isset($users_type) && ($users_type == 2)) {
            $baseCountConditions['Users.partner_id'] = $users_id;
        }
        $tabCountAll      = $this->Users->find('all')->where($baseCountConditions)->count();
        $tabCountActive   = $this->Users->find('all')->where($baseCountConditions)->where(['Users.active' => '1'])->count();
        $tabCountInactive = $this->Users->find('all')->where($baseCountConditions)->where(['Users.active' => '0'])->count();
        $tabCountEnquiry  = $this->Users->find('all')->where($baseCountConditions)->where(['Users.active' => '2'])->count();
        // --------------------------------------------------

        $this->paginate = ['limit' => $norec, 'order' => ['Users.id' => 'DESC']];

        $users = $this->paginate($count)->toArray();
        $trainers = $this->Users->find('list')
            ->where(['Users.user_type' => 4, 'Users.partner_id' => $users_id]);

        $this->set(compact('users', 'name', 'status', 'norec', 'email', 'user_type', 'users_type', 'partners', 'partner', 'trainers', 'trainer', 'start_date', 'end_date', 'date_type', 'tabCountAll', 'tabCountActive', 'tabCountInactive', 'tabCountEnquiry'));
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
            'contain' => ['UserRemarks' => function ($q) {
                return $q->order(['UserRemarks.id' => 'DESC']);
            }]
        ]);

        // plans list
        $planData = [];
        $planSubscribers = $this->PlanSubscribers->find('all')
            ->where(['user_id' => $id, 'partner_id' => $this->usersdetail['users_id']])
            ->order(['id DESC'])
            ->toArray();
        if (!empty($planSubscribers)) {
            $i = 0;
            foreach ($planSubscribers as $plan) {
                $paidAmount = $this->Payments->find('all');
                $paidAmount =        $paidAmount->select(['sum' => $paidAmount->func()->sum('amount')])
                    ->where(['plan_subscriber_id' => $plan->id])->first();
                $paid = 0;
                if (!empty($paidAmount->sum)) {
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


        $this->set(compact('planData', 'user'));
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
                if ($users_type == 1) {
                    $subject              = 'Successfully Inquery | Datamonitoring';
                } else {
                    $subject              = 'Successfully Inquery | ' . $users_name;
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
                }
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'payment', $useradd->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'users_type'));
        $this->set('_serialize', ['user']);
    }

    public function payment($id = '')
    {
        $this->PlanSubscribers = TableRegistry::get('PlanSubscribers');
        $this->Payments        = TableRegistry::get('Payments');
        $planSubscribers       = $this->PlanSubscribers->newEntity();
        $payments              = $this->Payments->newEntity();
        $plandata              =   $paymentdata = [];
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_name = $this->usersdetail['users_name'];
        $users_id   = $this->usersdetail['users_id'];
        $user       = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            if (!empty($data['password'])) {
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
            if (!empty($data['trainer_userid'])) {
                $user->trainer_userid = $data['trainer_userid'];
            }
            $user                 = $this->Users->patchEntity($user, $data);
            $useradd              = $this->Users->save($user);
            if ($useradd) {

                // insert into plan_subscribers
                $plandata['user_id']         = $user->id;
                $plandata['partner_id']      = $this->usersdetail['users_id'];
                $plandata['plan_name']       = $data['plan_name'];
                $plandata['fee']             = $data['fee'];
                $plandata['currency']        = 'INR';
                $plandata['plan_expire_date'] = date('Y-m-d H:i:s', strtotime($data['plan_expire_date']));
                $plandata['payment_due_date'] = !empty($data['payment_due_date']) ? date('Y-m-d H:i:s', strtotime($data['payment_due_date'])) : null;
                if (!empty($data['subscription_start_date'])) {
                    $plandata['subscription_start_date'] = date('Y-m-d', strtotime($data['subscription_start_date']));
                }
                if (!empty($data['reminder_date'])) {
                    $plandata['reminder_date'] = date('Y-m-d', strtotime($data['reminder_date']));
                }
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
                if (!empty($data['password'])) {
                    $userDataArr['name']      = $data['name'];
                    $userDataArr['users_type'] = $users_type;
                    $userDataArr['users_name'] = $users_name;
                    $userDataArr['password']  = $data['cpassword'];
                    $userDataArr['email']     = $data['email'];
                    $userDataArr['planName']  = $data['plan_name'];
                    $userDataArr['expireDate'] = date('d M Y', strtotime($data['plan_expire_date']));
                    $userDataArr['totalFee']  = $data['fee'];
                    $userDataArr['paidAmount'] = $data['amount'];
                    $userDataArr['login_url'] = Router::url('/', ['controller' => 'Users', 'action' => 'login']);
                    $toEmail                  = $data['email'];
                    if ($users_type == 1) {
                        $subject              = 'Successfully Payment | Datamonitoring';
                    } else {
                        $subject              = 'Successfully Payment | ' . $users_name;
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
                if (empty($data['password'])) {
                    $this->Flash->success(__('The plan has been saved.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                } elseif ($useradd->user_type == 2) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                } else {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['controller' => 'FitnessMeserments', 'action' => 'add']);
                }
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $user_id = $id;
        $trainers = $this->Users->find('list')
            ->where(['Users.user_type' => 4, 'Users.partner_id' => $users_id]);

        $plansTable = TableRegistry::get('Plans');
        $planConditions = ['Plans.active' => 1];
        if ($users_type != 1) {
            $planConditions['Plans.partner_id'] = $users_id;
        }
        $availablePlans = $plansTable->find('list', [
            'keyField' => 'id',
            'valueField' => 'title'
        ])->where($planConditions)->toArray();

        $this->set(compact('user_id', 'user', 'trainers', 'users_type', 'availablePlans'));
        $this->set('_serialize', ['user_id', 'user', 'users_type']);
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
        $users_id = $this->usersdetail['users_id'];
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
            if (!empty($data['trainer_userid'])) {
                $user->trainer_userid = $data['trainer_userid'];
            }

            $user = $this->Users->patchEntity($user, $data);
            //   pr($user); die;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $trainers = $this->Users->find('list')
            ->where(['Users.user_type' => 4, 'Users.partner_id' => $users_id]);
        $this->set(compact('user', 'users_type', 'trainers', 'users_type'));
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


    public function verifiedUpdate()
    {
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
            ->select(['email', 'name'])
            ->where(['id' => $get_id])
            ->first();

        if ($verified_chg == '0') {

            echo '<button id=' . $get_id . ' class="btn btn-primary waves-effect" value=' . $verified_chg . ' onclick="updateVerified(this.id,' . $verified_chg . ')" type="submit">UnApproved</button>';
        } else {




            echo '<button id=' . $get_id . ' class="btn btn-success waves-effect" value=' . $verified_chg . ' onclick="updateVerified(this.id,' . $verified_chg . ')" type="submit">Approved</button>';
        }
    }


    public function status()
    {
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
    public function adminLogin()
    {
        $this->viewBuilder()->layout("ajax");
        // Only redirect to dashboard if this is a direct login action visit,
        // not when browsing the homepage while already logged in.
        // The homepage IS the adminLogin page, so we just render it normally.
    }
    public function dashboard()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_id = $this->usersdetail['users_id'];

        $uesrs = TableRegistry::get('Users');
        $query = $uesrs->find()->select(['Users.id'])
            ->where([
                'Users.active !=' => 2,
                'Users.user_type NOT IN' => ['1', '2', '4']
            ]);
        
        if (isset($users_type) && ($users_type == 2)) {
            $query->where(['Users.partner_id' => $users_id]);
        }
        
        $users_count = $query->count();

        // Initialize variables for popups
        $expiredMembers = [];
        $birthdayMembers = [];
        $isMyBirthday = false;

        $session = $this->request->session();
        if (!$session->read('DashboardAlertsShown')) {
            // 1. Expired subscriptions logic (For Admin, Partner, Trainer)
            if (in_array($users_type, ['1', '2', '4'])) {
                $psTable = TableRegistry::get('PlanSubscribers');
                $allSubsQuery = $psTable->find('all')
                    ->contain(['Users'])
                    ->where([
                        'Users.active !=' => 2,
                        'Users.user_type NOT IN' => ['1', '2', '4']
                    ]);

                if ($users_type == 2) {
                    $allSubsQuery->where(['Users.partner_id' => $users_id]);
                } elseif ($users_type == 4) {
                    $partnerId = isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : 0;
                    $allSubsQuery->where(['Users.partner_id' => $partnerId]);
                }

                $allSubs = $allSubsQuery->order(['PlanSubscribers.id' => 'DESC'])->toArray();

                $processedUsers = [];
                foreach ($allSubs as $sub) {
                    $uid = $sub->user_id;
                    if (in_array($uid, $processedUsers)) {
                        continue;
                    }
                    $processedUsers[] = $uid;

                    // Check if the latest subscription has expired EXACTLY TODAY (past ones ignored)
                    if ($sub->plan_expire_date && $sub->plan_expire_date->format('Y-m-d') == date('Y-m-d')) {
                        $expiredMembers[] = [
                            'user_name' => $sub->user->name,
                            'plan_name' => $sub->plan_name,
                            'expire_date' => $sub->plan_expire_date->format('d-m-Y')
                        ];
                    }
                }
            }

            // 2. Birthday greetings logic
            // For Members (user_type == 3), check if it's their own birthday today
            if ($users_type == 3) {
                $me = $uesrs->find('all')
                    ->where([
                        'Users.id' => $users_id,
                        'Users.dob IS NOT' => null,
                        'MONTH(Users.dob) =' => date('m'),
                        'DAY(Users.dob) =' => date('d')
                    ])
                    ->first();
                if ($me) {
                    $isMyBirthday = true;
                }
            }
            // For Admin (1), Partner (2), or Trainer (4) - fetch members having birthday today
            if (in_array($users_type, ['1', '2', '4'])) {
                $bquery = $uesrs->find('all')
                    ->where([
                        'Users.active !=' => 2,
                        'Users.user_type NOT IN' => ['1', '2', '4'],
                        'Users.dob IS NOT' => null,
                        'MONTH(Users.dob) =' => date('m'),
                        'DAY(Users.dob) =' => date('d')
                    ]);

                if ($users_type == 2) {
                    $bquery->where(['Users.partner_id' => $users_id]);
                } elseif ($users_type == 4) {
                    // Trainer uses partner_id from session/details
                    $partnerId = isset($this->usersdetail['partner_id']) ? $this->usersdetail['partner_id'] : 0;
                    $bquery->where(['Users.partner_id' => $partnerId]);
                }

                $birthdayMembers = $bquery->toArray();
            }

            $session->write('DashboardAlertsShown', true);
        }

        $this->set(compact('users_count', 'expiredMembers', 'birthdayMembers', 'isMyBirthday'));
    }


    public function login()
    {

        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            //echo 'ggg';
            $data = $this->request->data;

            $data['password'] = md5($this->request->data['password']);
            $data['email'] = $this->request->data['email'];


            $count = $this->Users->find()->select(['id'])->where(['email' => $data['email'], 'password' => $data['password'], 'active' => 1])->count();
            //pr($count); die;
            if ($count == 1) {
                $this->Cookie->write('user_email', $data['email']);
                $this->request->session()->write('Auth.User.email', $data['email']);

                $user_detail = $this->Users->find()->select(['id', 'user_type', 'name', 'email', 'partner_id'])->where(['email' => $data['email'], 'active' => 1])->first();
                $this->Cookie->write('users', ['users_id' => $user_detail->id, 'users_name' => $user_detail->name, 'users_email' => $user_detail->email, 'users_type' => $user_detail->user_type, 'partner_id' => $user_detail->partner_id]);
                $this->request->session()->write('users', ['users_id' => $user_detail->id, 'users_name' => $user_detail->name, 'users_email' => $user_detail->email, 'users_type' => $user_detail->user_type, 'partner_id' => $user_detail->partner_id]);
                if ($user_detail->user_type == 3) {
                    return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
                } else {
                    return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
                }
            } else {
                $this->Flash->error(__('This email and password not match'));
                return $this->redirect(['controller' => 'Users', 'action' => 'adminLogin']);
            }
        }
    }


    public function logout()
    {
        $this->autoRender = false;
        $this->Cookie->delete('user_email');
        $this->Cookie->delete('users');
        $this->request->session()->delete('users');
        $this->request->session()->destroy();
        $this->Auth->logout();
        return $this->redirect('/');
    }

    /*
    *forgot password page
    */
    public function forgotPassword()
    {
        $this->viewBuilder()->layout("ajax");
    }
    /*
     * forget password
     */
    public function forgetPassword()
    {
        $this->autoRender = false;
        // check email is registered with us
        //$users_type = $this->usersdetail['users_type'];
        //$users_name = $this->usersdetail['users_name'];
        $userData = $this->Users->find()->select(['id', 'name', 'partner_id'])->where(['email' => $this->request->data['email']]);
        $userDatas = $userData->first();
        $partner = $this->Users->find()->select(['id', 'name', 'user_type'])->where(['id' => $userDatas->partner_id])->first();
        if ($userData->count()) {
            // token and url generate
            $userData = $userData->first();
            $userid = $userData->id;
            $useremail = $this->request->data['email'];
            $tokenString = json_encode(['id' => $userid, 'email' => $useremail, 'uid' => time()]);
            $token = $this->Common->base64url_encode($tokenString);
            $postData = $this->request->data;
            $postData['user_id'] = $userid;
            $postData['token'] = $token;
            $postData['status'] = 1;
            $insertRequest = $this->Common->createToken($postData);
            if (!empty($insertRequest)) {
                $subject = 'Reset password link';
                $verifylink = SITE_URL . 'reset-password/' . $token;
                $userDataArr['name']  = $userData->name;
                $userDataArr['link']  = $verifylink;
                $userDataArr['users_type'] = $partner->user_type;
                $userDataArr['users_name'] = $partner->name;
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
    public function resetPassword($token)
    {
        $this->viewBuilder()->layout("ajax");
        $this->Tokens    = TableRegistry::get('Tokens');
        if (!empty($token)) {
            $tokenString = $this->Common->base64url_decode($token);
            $tokenArray  = json_decode($tokenString, true);
            //step-1 check token is valid and not expired
            $tokenData    = $this->Tokens->find()->select(['token'])
                ->where(['token' => $token, 'user_id' => $tokenArray['id'], 'email' => $tokenArray['email'], 'created >=' => date('Y-m-d H:i:s', strtotime('-1 Hour'))])
                ->order(['id DESC'])->first();
            if (!empty($tokenData)) {
                //if post 
                if ($this->request->is('post')) {
                    $postData = $this->request->data;
                    // check password and confirm password are same
                    if ($postData['newpassword'] == $postData['confirmpassword'] && !empty($postData['newpassword'])) {
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
    public function addPayment($userid)
    {
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
            $users = $this->Payments->Users->find(['list', 'contain' => ['Users', 'Partners']])
                ->where([$search]);
        } else {
            $users = $this->Payments->Users->find(['list', 'contain' => ['Users', 'Partners']]);
        }

        $partners = $this->Payments->Partners->find('list');
        $planSubscribers = $this->Payments->PlanSubscribers->find('list')
            ->where(['user_id' => $userid, 'partner_id' => $this->usersdetail['users_id']]);
        $this->set(compact('payment', 'users', 'partners', 'planSubscribers', 'userid'));
    }

    /*
     * show plan list select inout using ajax
     */
    public function showPlanList($userid)
    {
        $this->viewBuilder()->layout("ajax");
        $this->Payments    = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $planSubscribers = $this->Payments->PlanSubscribers->find('list', ['limit' => 200])
            ->where(['user_id' => $userid, 'partner_id' => $this->usersdetail['users_id']]);
        $this->set(compact('planSubscribers', 'userid'));
    }

    /*
     * show plan list select inout using ajax
     */
    public function showPlanDetails($planid)
    {
        $this->viewBuilder()->layout("ajax");
        $this->Payments    = TableRegistry::get('Payments');
        $this->PlanSubscribers    = TableRegistry::get('PlanSubscribers');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $planSubscribers = $this->PlanSubscribers->find('all')
            ->select(['id', 'fee', 'payment_due_date', 'plan_expire_date'])
            ->where(['id' => $planid])->first();
        $paidAmount = $this->Payments->find('all');
        $paidAmount =        $paidAmount->select(['sum' => $paidAmount->func()->sum('amount')])
            ->where(['plan_subscriber_id' => $planSubscribers->id])->first();
        $paid = 0;
        if (!empty($paidAmount->sum)) {
            $paid = $paidAmount->sum;
        }
        $remaining = $planSubscribers->fee - $paid;
        if (!empty($this->request->query('amount'))) {
            $updateLimit = $remaining + $this->request->query('amount');
            $paid = $paid - $this->request->query('amount');
            $remaining = $remaining + $this->request->query('amount');
        }
        echo '<div class="col-sm-12"><strong>Selected Plan Details:</strong></div>';
        echo '<div class="col-sm-4"><strong>Total Fee:</strong> INR ' . $planSubscribers->fee . '</div>';
        echo '<div class="col-sm-4"><strong>Paid Amount:</strong> INR ' . $paid . '</div>';
        echo '<div class="col-sm-4"><strong>Remaining Amount:</strong> INR ' . $remaining . '</div>';
        echo ' <input type="hidden" id="fee" name="fee" value="' . $remaining . '">';
        echo '<div class="col-sm-4"><strong>Payment Due Date:</strong> ' . date('d-m-Y', strtotime($planSubscribers->payment_due_date)) . '</div>';
        echo '<div class="col-sm-4"><strong>Plan Expire Date:</strong> ' . date('d-m-Y', strtotime($planSubscribers->plan_expire_date)) . '</div>';
        exit;
    }

    /**
     * trainerList method
     *
     * @return \Cake\Http\Response|void
     */
    public function trainerList()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $name = '';
        $email = '';
        $norec = 10;
        $status = '';
        $user_type = '';
        $partner   = '';
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
        if (isset($this->request->query['partners']) && trim($this->request->query['partners']) != "") {
            $partner = $this->request->query['partners'];
            $search['Users.partner_id'] = $partner;
        }

        if (isset($users_type) && ($users_type == 2)) {
            $search['Users.partner_id'] = $users_id;
        }
        $search['Users.user_type'] = 4;  //triner condition
        if (isset($search)) {

            $count = $this->Users->find('all')
                ->where([$search]);
        } else {
            $count = $this->Users->find('all');
        }

        $count = $count->where(['Users.active !=' => '3', 'Users.user_type !=' => '1']);

        $partners =  $this->Users->find('list')
            ->select(['id', 'name'])
            ->where(['user_type' => 2])
            ->toArray();

        $this->paginate = ['limit' => $norec, 'order' => ['Users.id' => 'DESC']];

        $users = $this->paginate($count)->toArray();

        $this->set(compact('users', 'name', 'status', 'norec', 'email', 'user_type', 'users_type', 'partners', 'partner'));
        $this->set('_serialize', ['users']);
    }

    /**
     * trainerAdd method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function trainerAdd()
    {
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $users_type = $this->usersdetail['users_type'];
        $users_email = $this->usersdetail['users_email'];
        $users_name = $this->usersdetail['users_name'];
        $users_id   = $this->usersdetail['users_id'];
        $user       = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $t    = time();
            $name = $data['name'] . $t;
            $data['partner_id'] = $users_id;
            $data['username']   = $this->slugify($name);
            $data['password']   = md5($this->request->data['password']);
            $data['guestid']    = $this->Cookie->read('guest_id');
            $data['user_type']   = '4';
            $data['verified']   = '1';
            $user = $this->Users->patchEntity($user, $data);
            $useradd = $this->Users->save($user);
            if ($useradd) {
                $userDataArr['name']  = $data['name'];
                $userDataArr['email'] = $data['email'];
                $userDataArr['users_name'] = $users_name;
                $userDataArr['users_type'] = $users_type;
                $toEmail              = $data['email'];
                $this->Flash->success(__('The trainer is added successfully.'));

                return $this->redirect(['action' => 'trainerList']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'users_type'));
        $this->set('_serialize', ['user']);
    }

    /**
     * trainerEdit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function trainerEdit($id = null)
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

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The trainer is updated successfully.'));

                return $this->redirect(['action' => 'trainerList']);
            }
            $this->Flash->error(__('The trainer could not be saved. Please, try again.'));
        }
        $this->set(compact('user', 'users_type'));
        $this->set('_serialize', ['user']);
    }

    /**
     * trainerView method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function trainerView($id = null)
    {
        $this->PlanSubscribers    = TableRegistry::get('PlanSubscribers');
        $this->Payments    = TableRegistry::get('Payments');
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set(compact('user'));
    }


    public function siteMap()
    {
        $this->viewBuilder()->layout('sitemap');
        $this->RequestHandler->respondAs('xml');
    }

    public function saveRemark()
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post']);

        $this->UserRemarks = TableRegistry::get('UserRemarks');
        $remarkEntity = $this->UserRemarks->newEntity();

        $data = $this->request->data;
        if (!empty($data['followup_date'])) {
            $data['followup_date'] = date('Y-m-d H:i:s', strtotime($data['followup_date']));
        }

        $remarkEntity = $this->UserRemarks->patchEntity($remarkEntity, $data);
        if ($this->UserRemarks->save($remarkEntity)) {
            $response = ['status' => 'success', 'message' => __('Remark saved successfully.')];
        } else {
            $errors = $remarkEntity->errors();
            $response = ['status' => 'error', 'message' => __('Could not save remark.'), 'errors' => $errors];
        }

        echo json_encode($response);
        exit;
    }

    public function getRemarks($userId)
    {
        $this->autoRender = false;
        $this->UserRemarks = TableRegistry::get('UserRemarks');

        $remarks = $this->UserRemarks->find('all')
            ->where(['user_id' => $userId])
            ->order(['created' => 'DESC'])
            ->toArray();

        $formatted = [];
        foreach ($remarks as $remark) {
            $formatted[] = [
                'remark' => h($remark->remark),
                'followup_date' => $remark->followup_date ? $remark->followup_date->format('Y-m-d H:i:s') : 'N/A',
                'created' => $remark->created ? $remark->created->format('Y-m-d H:i:s') : 'N/A'
            ];
        }

        echo json_encode($formatted);
        exit;
    }

    public function composerUpdate()
    {
        if (empty($this->usersdetail['users_type']) || $this->usersdetail['users_type'] != 1) {
            throw new \Cake\Network\Exception\ForbiddenException(__('You are not authorized to access this section.'));
        }

        $this->autoRender = false;
        
        // Disable output buffering to stream results in real-time
        if (ob_get_level()) {
            ob_end_clean();
        }
        ob_implicit_flush(true);
        
        header('Content-Type: text/plain; charset=utf-8');
        header('X-Content-Type-Options: nosniff');

        // Set high limits
        set_time_limit(900); // 15 minutes
        ini_set('memory_limit', '1024M');

        $rootDir = ROOT; // CakePHP constant for application root directory
        chdir($rootDir);

        // Set Composer environment variables (required for web-server user context)
        $composerHome = $rootDir . DS . 'tmp' . DS . '.composer';
        if (!is_dir($composerHome)) {
            @mkdir($composerHome, 0777, true);
        }
        putenv("HOME=" . $rootDir . DS . 'tmp');
        putenv("COMPOSER_HOME=" . $composerHome);

        $envVars = array_merge($_SERVER, [
            'HOME' => $rootDir . DS . 'tmp',
            'COMPOSER_HOME' => $composerHome,
        ]);

        echo "Starting secure composer update on live environment...\n";
        echo "Logged in as Admin: " . $this->usersdetail['users_name'] . "\n";
        echo "Working directory: " . getcwd() . "\n";
        echo "PHP Version: " . PHP_VERSION . "\n";
        echo "PHP Binary: " . (defined('PHP_BINARY') ? PHP_BINARY : 'php') . "\n";

        // Helper function to execute and stream command output
        $runCommand = function($cmd) use ($envVars) {
            echo "\nExecuting: $cmd\n";
            echo str_repeat('-', 80) . "\n";
            
            $descriptorSpec = [
                0 => ["pipe", "r"], // stdin
                1 => ["pipe", "w"], // stdout
                2 => ["pipe", "w"]  // stderr
            ];
            
            $process = proc_open($cmd, $descriptorSpec, $pipes, null, $envVars);
            
            if (is_resource($process)) {
                fclose($pipes[0]); // Don't need stdin
                
                // Read stdout and stderr in real-time
                while (!feof($pipes[1]) || !feof($pipes[2])) {
                    $out = fgets($pipes[1]);
                    if ($out !== false) {
                        echo $out;
                        flush();
                    }
                    $err = fgets($pipes[2]);
                    if ($err !== false) {
                        echo "ERR: " . $err;
                        flush();
                    }
                }
                
                fclose($pipes[1]);
                fclose($pipes[2]);
                
                $returnValue = proc_close($process);
                echo str_repeat('-', 80) . "\n";
                echo "Command returned: $returnValue\n";
                return $returnValue === 0;
            } else {
                echo "Failed to start process.\n";
                return false;
            }
        };

        // 1. Check if shell execution is available
        if (!function_exists('proc_open')) {
            die("Error: proc_open() function is disabled in php.ini. Cannot run shell commands.\n");
        }

        // 2. Determine PHP command name
        $phpPath = defined('PHP_BINARY') && PHP_BINARY ? PHP_BINARY : 'php';
        // Convert lsphp SAPI path to CLI php path if applicable
        if (strpos($phpPath, 'lsphp') !== false) {
            $cliPath = str_replace('lsphp', 'php', $phpPath);
            if (@file_exists($cliPath) || @is_executable($cliPath)) {
                $phpPath = $cliPath;
            }
        }

        // 3. Test if global composer is available
        echo "Checking if global composer is available...\n";
        $hasGlobalComposer = false;
        $descriptorSpec = [1 => ["pipe", "w"], 2 => ["pipe", "w"]];
        $process = proc_open("composer --version", $descriptorSpec, $pipes, null, $envVars);
        if (is_resource($process)) {
            $out = stream_get_contents($pipes[1]);
            $err = stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            $code = proc_close($process);
            if ($code === 0) {
                $hasGlobalComposer = true;
                echo "Found global composer: " . trim($out) . "\n";
            }
        }

        $composerCmd = 'composer';

        if (!$hasGlobalComposer) {
            echo "Global composer not found. Checking for composer.phar in root...\n";
            if (!file_exists('composer.phar')) {
                echo "Downloading composer.phar...\n";
                $installerUrl = 'https://getcomposer.org/installer';
                $installerCode = file_get_contents($installerUrl);
                if ($installerCode === false) {
                    die("Error: Failed to fetch composer installer from $installerUrl\n");
                }
                file_put_contents('composer-setup.php', $installerCode);
                
                echo "Running composer setup...\n";
                $setupSuccess = $runCommand("\"$phpPath\" -d register_argc_argv=Off composer-setup.php");
                unlink('composer-setup.php');
                
                if (!$setupSuccess || !file_exists('composer.phar')) {
                    die("Error: Failed to download composer.phar\n");
                }
                echo "composer.phar downloaded successfully!\n";
            } else {
                echo "Found existing composer.phar in root.\n";
            }
            
            // Create wrapper script to manually define argv and argc for Symfony console
            $wrapperFile = $rootDir . DS . 'run_composer.php';
            $wrapperCode = '<?php
$_SERVER[\'argv\'] = [\'composer.phar\', \'update\', \'--no-interaction\', \'--optimize-autoloader\'];
$_SERVER[\'argc\'] = count($_SERVER[\'argv\']);
$argv = $_SERVER[\'argv\'];
$argc = $_SERVER[\'argc\'];
require \'composer.phar\';';
            
            file_put_contents($wrapperFile, $wrapperCode);
            $composerCmd = "\"$phpPath\" -d register_argc_argv=Off run_composer.php";
        }

        // 4. Run composer update
        if ($composerCmd === 'composer') {
            $command = $composerCmd . " update --no-interaction --optimize-autoloader";
        } else {
            $command = $composerCmd;
        }
        
        echo "Starting composer update...\n";
        $success = $runCommand($command);

        // Clean up wrapper script
        if (isset($wrapperFile) && file_exists($wrapperFile)) {
            @unlink($wrapperFile);
        }

        if ($success) {
            echo "\nComposer update completed successfully!\n";
        } else {
            echo "\nComposer update failed.\n";
        }
        
        exit();
    }

    public function beforeRender(\Cake\Event\Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
