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
        $sdate ='';
        $edate ='';
        $search = [];
         if (isset($this->request->query['from_date']) && trim($this->request->query['from_date']) != "" && isset($this->request->query['to_date']) && trim($this->request->query['to_date']) != "" ) {
          
            $sdate = date('Y-m-d H:i:s',strtotime($this->request->query['from_date'])); 
            $edate = date('Y-m-d H:i:s',strtotime($this->request->query['to_date'])) ;

            $search['FitnessMeserments.date >='] = $sdate;
            $search['FitnessMeserments.date <='] = $edate;  
            $sdate = $this->request->query['from_date']; 
            $edate = $this->request->query['to_date'] ;

             
        }
        
         if (isset($search)) {

            $count = $this->FitnessMeserments->find('all')
                    ->where([$search]);
        } else {
            $count = $this->FitnessMeserments->find('all');
        }

        //$count = $count->where(['Users.active !=' => '3']);

        $this->paginate = ['order' => ['FitnessMeserments.id' => 'DESC'],'contain' => ['Users']];
        $fitnessMeserments = $this->paginate($count)->toArray();
       // $users = $this->paginate($this->Users);
        $this->set(compact('fitnessMeserments','sdate','edate' ));
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
        $moredata ='weight';
        if (isset($this->request->query['moredata']) && $this->request->query['moredata'] != "") {
            $moredata = $this->request->query['moredata'];
        }
        
       $fitnessMeserment = $this->FitnessMeserments->find()
                                   ->select(['id','weight','height','bmi','created','date','thigh','hips','waist','chest','neck','upper_arm'])
                                   ->contain(['Users'])
                                   ->where(['FitnessMeserments.user_id'=>$user_id, 'FitnessMeserments.id <=' =>$id])
                                   ->order(['FitnessMeserments.id DESC'])->limit(2)->toArray();
       
      //pr($fitnessMeserment); die;
       if  (isset($moredata) && !empty($moredata)) {
                $fitnessMeserments = $this->FitnessMeserments->find()
                                   ->select(['id',$moredata,'created'])
                                   ->contain(['Users'])
                                   ->where(['FitnessMeserments.user_id'=>$user_id])
                                   ->order(['FitnessMeserments.id DESC'])->limit(10)->toArray();
                
                
             $chartshow = [];
        foreach ($fitnessMeserments as $key => $value) {
            $date = date("Y-m-d",strtotime($value->created));
            
                $chartshow[$key] =  ['y' => $date,'Dates' =>$value->$moredata]; 
               // $chartshow[$key] =  ['y' => $value->weight,'x' =>$value->height]; 
            }
            }
       
       
            
          //pr($chartshow); die;
         //pr(json_encode($chartshow,JSON_NUMERIC_CHECK)); 
        // $chartshow = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',json_encode($chartshow));
       //pr($chartshow); 
      // die;
       
       
        $this->set(compact('fitnessMeserment', 'chartshow','moredata'));
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

                return $this->redirect(['controller'=>'FitnessTests', 'action' => 'add']);
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
