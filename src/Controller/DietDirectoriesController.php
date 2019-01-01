<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * DietDirectories Controller
 *
 * @property \App\Model\Table\DietDirectoriesTable $DietDirectories
 *
 * @method \App\Model\Entity\DietDirectory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DietDirectoriesController extends AppController
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
        $name = '';
        $norec = 10;
        $status = '';
        $partner = '';
        $search = [];
        $users_id = $this->usersdetail['users_id'];
        $user_type = $this->usersdetail['users_type'];
       // pr($user_type); die;
        
        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['DietDirectories.name REGEXP'] = $name;
        }
         if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['DietDirectories.status'] = $status;
        }
         if (isset($this->request->query['partner']) && trim($this->request->query['partner']) != "") {
            $partner = $this->request->query['partner'];
            $search['DietDirectories.user_id'] = $partner;
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        if (isset($search)) {
            $count = $this->DietDirectories->find('all')
                    ->where([$search]);
        } else {
            $count = $this->DietDirectories->find('all');
        }
        if($user_type ==1)
        {
        $count = $count->where(['DietDirectories.status !=' => '2']);
        }
        if($user_type ==2)
        {
      $count = $count->where(['DietDirectories.status !=' => '2']);     
       $count = $count->where(['OR' =>['DietDirectories.user_id' => $users_id ,'DietDirectories.user_type' =>1]]);    
       // $count = $count->where(['DietDirectories.status !=' => '2','DietDirectories.user_id'=>$users_id]);
        }

        $this->paginate = [
            'limit' => $norec, 
            'order' => ['DietDirectories.id' => 'DESC'],
            
        ];
        $dietDirectories = $this->paginate($count);

        $this->set(compact('dietDirectories','name','status','norec','user_type','partner','users_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Diet Directory id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dietDirectory = $this->DietDirectories->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('dietDirectory', $dietDirectory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dietDirectory = $this->DietDirectories->newEntity();
        if ($this->request->is('post')) {
            $dietDirectory = $this->DietDirectories->patchEntity($dietDirectory, $this->request->getData());
            if ($this->DietDirectories->save($dietDirectory)) {
                $this->Flash->success(__('The diet directory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diet directory could not be saved. Please, try again.'));
        }
        $users = $this->DietDirectories->Users->find('list', ['limit' => 200]);
        $this->set(compact('dietDirectory', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Diet Directory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dietDirectory = $this->DietDirectories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dietDirectory = $this->DietDirectories->patchEntity($dietDirectory, $this->request->getData());
            if ($this->DietDirectories->save($dietDirectory)) {
                $this->Flash->success(__('The diet directory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diet directory could not be saved. Please, try again.'));
        }
        $users = $this->DietDirectories->Users->find('list', ['limit' => 200]);
        $this->set(compact('dietDirectory', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Diet Directory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $dietDirectory = $this->DietDirectories->get($id);
        if ($this->DietDirectories->delete($dietDirectory)) {
            $this->Flash->success(__('The diet directory has been deleted.'));
        } else {
            $this->Flash->error(__('The diet directory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function status() {
     if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $id     = $this->request->params['pass'][0];
        $status = $this->request->params['pass'][1];
        $user   = $this->DietDirectories->get($id);
        if ($status == 1) {
            $user_data['status'] = 0;
            $user_data['id'] = $id;
            $user = $this->DietDirectories->patchEntity($user, $user_data);
            if ($this->DietDirectories->save($user)) {
                $st = $user_data['status'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                // echo "<a href= '#' onclick = 'updateStatus(" . $id . "," . $user_data['status'] . ")'> " . $st . " </a>";
                echo '<button id=' . $id . ' class="btn btn-primary waves-effect status" value=' . $user_data['status'] . ' onclick="updateStatus(this.id,' . $user_data['status'] . ')" type="submit">Inactive</button>';
                exit;
            }
        } else {
            $user_data['status'] = 1;
            $user_data['id'] = $id;
            $user = $this->DietDirectories->patchEntity($user, $user_data);
            if ($this->DietDirectories->save($user)) {
                $st = $user_data['status'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                echo '<button id=' . $id . ' class="btn btn-success waves-effect status" value=' . $user_data['status'] . ' onclick="updateStatus(this.id,' . $user_data['status'] . ')" type="submit">Active</button>';
                exit;
            }
        }
    }
  
  public function addDiet() {
             $this->viewBuilder()->layout("ajax");
             $exrcisedirectorie_id ='';
             $start_id ='';
             $first = 'no';
             $dietdirectories_id = $this->request->data['dietdirectories_id'];
             $start_id = $this->request->data['start'];
             if(!empty($this->request->data['first'])) {
                $first = $this->request->data['first'];
             }
             $users_id = $this->usersdetail['users_id'];
             $new_id = '';
//             if(isset($new_id) && !empty($new_id))
//             {
//                 if($new_id == $exrcisedirectorie_id)
//                 {
//                     $new_id = $exrcisedirectorie_id;
//                 }
//                 
//             }
//             
             $this->request->session()->write('addmore',$dietdirectories_id);
             
              $get_dietdirectories = $this->DietDirectories->find()->select(['name', 'technical1','id','technical2','technical3','technical4','technical5'])->where(['status' => 1,'id'=>$dietdirectories_id])->first();
  //pr($get_exrcisedirectories); die;
       $this->set(compact('get_dietdirectories','new_id','dietdirectories_id','start_id','users_id','first'));
    }


    
      public function partnerExcr() {
         $this->viewBuilder()->layout("ajax");
       $users_id = $this->request->data['partner_id'];
      // pr($users_id); die;
      // $get_exrcisedirectories = TableRegistry::get('ExrciseDirectories');
       if(isset($users_id) && !empty($users_id))
       {
       $get_exrcisedirectorie_lists = $this->DietDirectories->find('list')->where(['status' => 1,'user_id'=>$users_id])->toArray();
       } else {
           $users_id = $this->usersdetail['users_id'];
      $get_exrcisedirectorie_lists = $this->DietDirectories->find('list')->where(['status' => 1,'user_id'=>$users_id])->toArray();
       
       }
        $this->set(compact('get_exrcisedirectorie_lists'));
       // $this->set('_serialize', ['cities']); 
       
    }
    


    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
