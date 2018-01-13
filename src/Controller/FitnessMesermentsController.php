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
 * FitnessMeserments Controller
 *
 * @property \App\Model\Table\FitnessMesermentsTable $FitnessMeserments
 *
 * @method \App\Model\Entity\FitnessMeserment[] paginate($object = null, array $settings = [])
 */
class FitnessMesermentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
      public function initialize()
    {

        parent::initialize();
        $this->loadComponent('Flash'); 
    }
    
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
       // $this->Users->userAuth = $this->UserAuth;
        $this->Auth->allow(['index','add','view','edit','login','status','adminLogin','verifiedUpdate','logout','payment','getLastValue']);
        
    }
    
    
    public function index()
    {
        
        if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }

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

            $count = $this->FitnessMeserments->find('all')
                    ->where([$search]);
        } else {
            $count = $this->FitnessMeserments->find('all');
        }

        //$count = $count->where(['Users.active !=' => '3']);




        $this->paginate = ['limit' => $norec, 'order' => ['FitnessMeserments.id' => 'DESC'],'contain' => ['Users']];

        $fitnessMeserments = $this->paginate($count)->toArray();

        
        
        
        
       // $users = $this->paginate($this->Users);

        $this->set(compact('fitnessMeserments', 'name', 'status', 'norec','email'));
        $this->set('_serialize', ['fitnessMeserments']);
        
        
    }

    /**
     * View method
     *
     * @param string|null $id Fitness Meserment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
                     if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $user_id = $this->usersdetail['users_id'];
        
       $fitnessMeserment = $this->FitnessMeserments->find()
                                   ->contain(['Users'])
                                   ->where(['FitnessMeserments.user_id'=>$user_id, 'FitnessMeserments.id <=' =>$id])
                                   ->order(['FitnessMeserments.id DESC'])->limit(2)->toArray();
       //pr($fitnessMeserments); die;

        $this->set('fitnessMeserment', $fitnessMeserment);
        $this->set('_serialize', ['fitnessMeserment']);
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
        
        $fitnessMeserment = $this->FitnessMeserments->newEntity();
        if ($this->request->is('post')) {
             $data = $this->request->data;
             $data['user_id'] = $this->usersdetail['users_id'];
             $data['bmi']     = floor($data['bmi']);
            $fitnessMeserment = $this->FitnessMeserments->patchEntity($fitnessMeserment, $data);
            //pr($fitnessMeserment); die;
            if ($this->FitnessMeserments->save($fitnessMeserment)) {
                $this->Flash->success(__('The body meserment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The body meserment could not be saved. Please, try again.'));
        }
        $users = $this->FitnessMeserments->Users->find('list', ['limit' => 200]);
        $this->set(compact('fitnessMeserment', 'users'));
        $this->set('_serialize', ['fitnessMeserment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fitness Meserment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
                     if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        
        $fitnessMeserment = $this->FitnessMeserments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            $data['user_id'] = $this->usersdetail['users_id'];
            
            $fitnessMeserment = $this->FitnessMeserments->patchEntity($fitnessMeserment, $data);
            if ($this->FitnessMeserments->save($fitnessMeserment)) {
                $this->Flash->success(__('The body meserment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The body meserment could not be saved. Please, try again.'));
        }
        $users = $this->FitnessMeserments->Users->find('list', ['limit' => 200]);
        $this->set(compact('fitnessMeserment', 'users'));
        $this->set('_serialize', ['fitnessMeserment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fitness Meserment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
                     if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        
        $this->request->allowMethod(['post', 'delete']);
        $fitnessMeserment = $this->FitnessMeserments->get($id);
        if ($this->FitnessMeserments->delete($fitnessMeserment)) {
            $this->Flash->success(__('The body meserment has been deleted.'));
        } else {
            $this->Flash->error(__('The body meserment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
     public function getLastValue()
                      {
            $this->autoRender=false;
            $get_name = $this->request->data['fitnessfield'];
            $position = $this->request->data['position'];
            $user_id = $this->usersdetail['users_id'];
           
          
           
           
             $getfield = $this->FitnessMeserments->find()
                                   ->select([$get_name])
                                   ->where(['user_id'=>$user_id])
                                   ->order(['id Asc'])->first();
          echo $getfield->$get_name;
          exit();
          
                      }
     
    
    
   public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    } 
    
}
