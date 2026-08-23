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
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        if (!empty($this->usersdetail['users_type']) && $this->usersdetail['users_type'] == 5) {
            $this->Flash->error(__('Access Denied. Front Desk role is restricted from this module.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'dashboard']);
        }
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
        $users_id  = $this->usersdetail['users_id'];
        $name      = '';
        $sdate     ='';
        $edate     ='';
        $norec     = 20;
        $status    = '';
        $partner   = '';
        $stat      = '';
        $search    = [];
        $s_type    = '';
         if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['Sessions.user_id'] = $name;
        }
        if (isset($this->request->query['s_type']) && trim($this->request->query['s_type']) != "") {
            $s_type = $this->request->query['s_type'];
            //$search['Users.name REGEXP'] = $name;
            $search['Sessions.session_type REGEXP'] = $s_type;
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
        if (isset($this->request->query['stat']) && trim($this->request->query['stat']) != "" && ($this->request->query['stat']) == '1') {
            $stat = $this->request->query['stat'];
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
        // Calculate counts for today's statistics
        $today = date('Y-m-d');
        $usersTable = \Cake\ORM\TableRegistry::get('Users');
        
        $userConditions = ['Users.active' => '1', 'Users.user_type' => '3'];
        if (isset($user_type) && ($user_type == 2)) {
            $userConditions['Users.partner_id'] = $users_id;
        } elseif (isset($user_type) && ($user_type == 4)) {
            $userConditions['Users.trainer_userid'] = $users_id;
        } elseif (isset($user_type) && ($user_type == 3)) {
            $userConditions['Users.id'] = $users_id;
        }
        
        $totalUsersQuery = $usersTable->find('all')->where($userConditions);
        $totalUsersCount = $totalUsersQuery->count();
        $activeUserIds = $totalUsersQuery->select(['id'])->extract('id')->toArray();
        
        $createdCount = 0;
        $notCreatedCount = 0;
        $notAttendedCount = 0;
        
        if (!empty($activeUserIds)) {
            $sessionsTable = \Cake\ORM\TableRegistry::get('Sessions');
            $todaySessions = $sessionsTable->find('all')
                ->where([
                    'Sessions.date' => $today,
                    'Sessions.status !=' => '2',
                    'Sessions.user_id IN' => $activeUserIds
                ])
                ->toArray();
                
            $createdUserIds = [];
            foreach ($todaySessions as $s) {
                $createdUserIds[] = $s->user_id;
                if (empty($s->user_detail)) {
                    $notAttendedCount++;
                }
            }
            $createdUserIds = array_unique($createdUserIds);
            $createdCount = count($createdUserIds);
            $notCreatedCount = max(0, $totalUsersCount - $createdCount);
        }

        $todayFilter = $this->request->query['today_filter'] ?? '';
        $sessions = [];
        $isVirtualList = false;

        if ($todayFilter !== '') {
            $search = []; // Clear other search parameters to prioritize today filter
            if ($todayFilter === 'created') {
                $count = $this->Sessions->find('all')
                    ->where([
                        'Sessions.date' => $today,
                        'Sessions.status !=' => '2',
                        'Sessions.user_id IN' => $activeUserIds
                    ]);
            } elseif ($todayFilter === 'not_attended') {
                $count = $this->Sessions->find('all')
                    ->where([
                        'Sessions.date' => $today,
                        'Sessions.status !=' => '2',
                        'Sessions.user_id IN' => $activeUserIds,
                        'Sessions.user_detail IS NULL'
                    ]);
            } elseif ($todayFilter === 'not_created') {
                $isVirtualList = true;
                $usersWithSessionToday = [];
                if (!empty($activeUserIds)) {
                    $usersWithSessionToday = \Cake\ORM\TableRegistry::get('Sessions')->find()
                        ->select(['user_id'])
                        ->where([
                            'date' => $today,
                            'status !=' => '2',
                            'user_id IN' => $activeUserIds
                        ])
                        ->extract('user_id')
                        ->toArray();
                }
                
                $usersWithoutSessionConditions = $userConditions;
                if (!empty($usersWithSessionToday)) {
                    $usersWithoutSessionConditions['Users.id NOT IN'] = $usersWithSessionToday;
                }
                
                $usersWithoutSession = $usersTable->find('all')
                    ->where($usersWithoutSessionConditions)
                    ->toArray();
                    
                $virtualSessions = [];
                foreach ($usersWithoutSession as $u) {
                    $virtualSessions[] = new \App\Model\Entity\Session([
                        'id' => null,
                        'user' => $u,
                        'user_id' => $u->id,
                        'body_weight' => '',
                        'notes' => 'No session created for today',
                        'date' => new \Cake\I18n\Time($today),
                        'session_type' => 'N/A',
                        'status' => '0',
                        'user_detail' => null,
                        'is_virtual' => true
                    ]);
                }
                $sessions = $virtualSessions;
            } elseif ($todayFilter === 'total') {
                $isVirtualList = true;
                $createdToday = $this->Sessions->find('all')
                    ->contain(['Users'])
                    ->where([
                        'Sessions.date' => $today,
                        'Sessions.status !=' => '2',
                        'Sessions.user_id IN' => $activeUserIds
                    ])
                    ->toArray();
                
                $createdUserIds = array_column($createdToday, 'user_id');
                
                $usersWithoutSessionConditions = $userConditions;
                if (!empty($createdUserIds)) {
                    $usersWithoutSessionConditions['Users.id NOT IN'] = $createdUserIds;
                }
                
                $usersWithoutSession = $usersTable->find('all')
                    ->where($usersWithoutSessionConditions)
                    ->toArray();
                    
                $virtualSessions = [];
                foreach ($usersWithoutSession as $u) {
                    $virtualSessions[] = new \App\Model\Entity\Session([
                        'id' => null,
                        'user' => $u,
                        'user_id' => $u->id,
                        'body_weight' => '',
                        'notes' => 'No session created for today',
                        'date' => new \Cake\I18n\Time($today),
                        'session_type' => 'N/A',
                        'status' => '0',
                        'user_detail' => null,
                        'is_virtual' => true
                    ]);
                }
                $sessions = array_merge($createdToday, $virtualSessions);
            }
        }

        if (!$isVirtualList) {
            if ($todayFilter === '') {
                if (!empty($search)) {
                    $count = $this->Sessions->find('all')
                            ->contain(['Users'])
                            ->where([$search])
                            ->order(['date' => 'DESC']);
                } else {
                    $count = $this->Sessions->find('all')->contain(['Users']);
                }
                
                if (isset($user_type) && ($user_type == 3)) {
                    $count = $count->where(['Sessions.status ' => '1' ,'Sessions.date <=' => date('Y-m-d')]);
                } else {
                    $count = $count->where(['Sessions.status !=' => '2']);
                }
                if (isset($sessions_value) && !empty($sessions_value)) {
                    $count = $count->where(['date <' => date('Y-m-d') ,'user_detail Is Null']);  
                }
                if (isset($stat) && !empty($stat)) {
                    $count = $count->where(['user_detail Is Null']);  
                }
            }
            
            $this->paginate = [
                'contain' => ['Users'],
                'limit' => $norec, 
                'order' => ['Sessions.id' => 'DESC'],
            ];
            $sessions = $this->paginate($count);
        } else {
            // Setup pagination metadata manually for virtual arrays to keep PaginatorHelper happy
            $totalCount = count($sessions);
            $this->request->params['paging']['Sessions'] = [
                'finder' => 'all',
                'page' => 1,
                'current' => $totalCount,
                'count' => $totalCount,
                'perPage' => $norec,
                'prevPage' => false,
                'nextPage' => false,
                'pageCount' => 1,
                'sort' => null,
                'direction' => null,
                'limit' => $norec,
                'sortDefault' => [],
                'directionDefault' => [],
                'scope' => null
            ];
        }

        if ($user_type == 4) {
            $users = $this->Sessions->Users->find('list')->where(['Users.active' => '1' ,'Users.trainer_userid'=> $users_id,'user_type' =>3]);
        } else {
            $users = $this->Sessions->Users->find('list')->where(['Users.active' => '1' ,'Users.partner_id'=> $users_id,'user_type' =>3]);
        }
        
        $this->set(compact('sessions','name','status','norec','users','user_type','sdate','edate','partner','stat','s_type', 'totalUsersCount', 'createdCount', 'notCreatedCount', 'notAttendedCount', 'todayFilter'));
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
        $user_type  = $this->usersdetail['users_type'];
        $partner_id = $this->usersdetail['partner_id'];
        $users_id   = $this->usersdetail['users_id'];
        $session    = $this->Sessions->newEntity();
        if ($this->request->is('post')) {
            $datas =[];
            $data  = $this->request->data;
            $users = $this->request->data['user_id'];
            $dates = explode(',',substr($data['date'],0,-1));
            foreach($dates as $date) {
                foreach($users as $value)
                {
                   if($user_type != 3)
              {
                  $datas['partner_id'] = $this->usersdetail['users_id'];     
                  $datas['user_id'] = $value;     
              }   
                      $datas['ex_detail']       = json_encode($data['excrcise']);
                      $datas['status']          = $data['status'];
                      $datas['session_type']    = $data['session_type'];
                      $datas['date']            = $date;

                  $sessione = $this->Sessions->newEntity();
                  $session  = $this->Sessions->patchEntity($sessione, $datas);
                 
                  if ($this->Sessions->save($session)) {
                      // $this->Flash->success(__('The session has been created.'));

                     // return $this->redirect(['action' => 'index']);
                  }
                 // $this->Flash->error(__('The session could not be saved. Please, try again.'));
              }
            }
         return $this->redirect(['action' => 'index']);
        }
        if ($this->request->query('user_id')) {
            $session->user_id = [$this->request->query('user_id')];
        }
        $AdminofTrainner = $this->Sessions->Users->find()
                                       ->select(['partner_id'])
                                       ->where(['id =' => $partner_id])->first();
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
            $datas =[];
            $data = $this->request->data;
    // pr($data); die;
             if($user_type != 3)
        {
            $datas['partner_id'] = $this->usersdetail['users_id'];     
            $datas['user_id'] = $this->request->data['user_id'];     
        }     
                 $datas['ex_detail']      = json_encode($data['excrcise']);
                $datas['status']          = $data['status'];
                $datas['session_type']    = $data['session_type'];
                $datas['date']            = $data['date'];
                
             //   pr($datas); die;
            $session = $this->Sessions->patchEntity($session, $datas);
            if ($this->Sessions->save($session)) {
                $this->Flash->success(__('The session has been edited.'));

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
           $datas =[];
            $data = $this->request->data;
            $users = $this->request->data['user_id'];
        // pr($users); die;
            $dates = explode(',',substr($data['date'],0,-1));
            foreach($dates as $date) {
                foreach($users as $value)
                {

                   if($user_type != 3)
              {
                  $datas['partner_id'] = $this->usersdetail['users_id'];     
                  $datas['user_id'] = $value;     
              }   

                  //pr($data); die;
                      $datas['ex_detail']       = json_encode($data['excrcise']);
                      $datas['status']          = $data['status'];
                      $datas['session_type']    = $data['session_type'];
                      $datas['date']            = $date;

                   //  pr($datas); die;
                  $sessione = $this->Sessions->newEntity();
                  $sessions  = $this->Sessions->patchEntity($sessione, $datas);
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
            $datas =[];
            $data = $this->request->data;
          //pr($data); die;
            $datas['user_detail'] = json_encode($data['userexcrcise']);
            $datas['user_date']   = date('Y-m-d');
            $datas['body_weight'] = $this->request->data('body_weight');
            $datas['hydration']   = $this->request->data('hydration');
            $datas['sleep']       = $this->request->data('sleep');
            $datas['notes']       = $this->request->data('notes');
             //  pr($datas); die;
            $session = $this->Sessions->patchEntity($session, $datas);
            if ($this->Sessions->save($session)) {
                $this->Flash->success(__('The session has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The session could not be saved. Please, try again.'));
        }
         $session_values = json_decode($session->ex_detail);
         $session_user_values = json_decode($session->user_detail);
         if(isset($session_user_values) && !empty($session_user_values))
         {
            $users_diet_values = $session_user_values;
         }else
         {
          $users_diet_values =   $session_values;
         }
      // pr($session_values); die;
        //$users = $this->Sessions->Users->find('list', ['limit' => 200]);
       // $partners = $this->Sessions->Partners->find('list', ['limit' => 200]);
        $this->set(compact('session', 'users', 'partners','user_type','session_values','users_id','users_diet_values'));
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
