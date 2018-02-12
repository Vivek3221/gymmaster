<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Network\Http\Client;

/**
 * FitnessTests Controller
 *
 * @property \App\Model\Table\FitnessTestsTable $FitnessTests
 *
 * @method \App\Model\Entity\FitnessTest[] paginate($object = null, array $settings = [])
 */
class FitnessTestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
      public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
       // $this->Users->userAuth = $this->UserAuth;
        $this->Auth->allow(['index','add','view','delete','edit','status']);
        
    }
    
    public function index()
    {
                      if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $sdate ='';
        $edate ='';
        $this->paginate = [
            'contain' => ['Exercises']
        ];
        $fitnessTests = $this->paginate($this->FitnessTests);
//pr($fitnessTest); die;
        $this->set(compact('fitnessTests','sdate','edate'));
        $this->set('_serialize', ['fitnessTests']);
    }

    /**
     * View method
     *
     * @param string|null $id Fitness Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
                      if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        
        $excerise_type = 'exercise_left';
        if (isset($this->request->query['excerise_type']) && $this->request->query['excerise_type'] != "") {
            $excerise_type = $this->request->query['excerise_type'];
        }
        $exercise_id = 1;
        if (isset($this->request->query['exercise_id']) && $this->request->query['exercise_id'] != "") {
            $exercise_id = $this->request->query['exercise_id'];
        }
        
        $user_id = $this->usersdetail['users_id'];
        $fitnessTest = $this->FitnessTests->find()
                                   ->select(['id','exercise_id','exercise_type'])
                                   ->contain(['Exercises'])
                                   ->where(['FitnessTests.user_id'=>$user_id, 'FitnessTests.id <=' =>$id])
                                   ->order(['FitnessTests.id DESC'])->limit(2)->toArray();
        
       if  (isset($exercise_id) && !empty($exercise_id)) {
                $fitnessTests = $this->FitnessTests->find()
                                   ->select(['id','exercise_id','exercise_type','created'])
                                   ->where(['FitnessTests.user_id'=>$user_id, 'FitnessTests.id <=' =>$id])
                                   ->order(['FitnessTests.id DESC'])->limit(10)->toArray();
                
             $chartshow = [];
        foreach ($fitnessTests as $key => $value) {
            $date = date("Y-m-d",strtotime($value->created));
              $preValue = json_decode($value->exercise_type); 
               $exercise_show = $preValue->$excerise_type->$exercise_id;
            
                $chartshow[$key] =  ['y' => $date,'Dates' =>$exercise_show]; 
               // $chartshow[$key] =  ['y' => $value->weight,'x' =>$value->height]; 
            }
            }
           
        $this->set(compact('fitnessTest', 'chartshow'));
        $this->set('_serialize', ['fitnessTest']);
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
       $fitnessTest = $this->FitnessTests->newEntity();
        if ($this->request->is('post')) {
            $data1 =[];
            $data2 =[];
            $data = $this->request->data;
            
            //pr($data); 
            $ids = implode(",", $data['exercise_id']);
            //pr($ids); die;
            $idl = $data['exercise_l'];
            $idr = $data['exerciser'];
            //$idt = $data['exercisert'];
            $user_id = $this->usersdetail['users_id'];

                $data2['exercise_left'] = $idl;
                $data2['exercise_right'] = $idr;
                $data1['status'] = $data['status'];
                $data1['user_id'] = $user_id;
                $data1['exercise_id'] = $ids;
             
                $data1['exercise_type'] = json_encode($data2);
               
               
                $fitnessTest = $this->FitnessTests->patchEntity($fitnessTest, $data1);
            if ($this->FitnessTests->save($fitnessTest)) {
           
           return $this->redirect(['action' => 'index']);
          
                
            }

        }
        $exercises = $this->FitnessTests->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('fitnessTest', 'exercises'));
        $this->set('_serialize', ['fitnessTest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fitness Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
                      if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        
        $fitnessTest = $this->FitnessTests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fitnessTest = $this->FitnessTests->patchEntity($fitnessTest, $this->request->getData());
             $data1 =[];
            $data2 =[];
            $data = $this->request->data;
            
            //pr($data); 
            $ids = implode(",", $data['exercise_id']);
            //pr($ids); die;
            $idl = $data['exercise_l'];
            $idr = $data['exerciser'];
            //$idt = $data['exercisert'];
            $user_id = $this->usersdetail['users_id'];

                $data2['exercise_left'] = $idl;
                $data2['exercise_right'] = $idr;
                $data1['status'] = $data['status'];
                //$data1['user_id'] = $user_id;
                $data1['exercise_id'] = $ids;
             
                $data1['exercise_type'] = json_encode($data2);
               
               
                $fitnessTest = $this->FitnessTests->patchEntity($fitnessTest, $data1);
            if ($this->FitnessTests->save($fitnessTest)) {
           
           return $this->redirect(['action' => 'index']);
          
                
            }
            $this->Flash->error(__('The fitness type could not be saved. Please, try again.'));
        }
        //$val = '1';
        $exercise_value = json_decode($fitnessTest->exercise_type);
        //pr($exercise_value->exercise_left->$val); die;
        
        $exercises = $this->FitnessTests->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('fitnessTest', 'exercises','exercise_value'));
        $this->set('_serialize', ['fitnessTest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fitness Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
                      if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        
        $this->request->allowMethod(['post', 'delete']);
        $fitnessTest = $this->FitnessTests->get($id);
        if ($this->FitnessTests->delete($fitnessTest)) {
            $this->Flash->success(__('The fitness type has been deleted.'));
        } else {
            $this->Flash->error(__('The fitness type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
   public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    } 
    
}
