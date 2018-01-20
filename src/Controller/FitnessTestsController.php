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
        
        $this->paginate = [
            'contain' => ['Exercises']
        ];
        $fitnessTests = $this->paginate($this->FitnessTests);
//pr($fitnessTest); die;
        $this->set(compact('fitnessTests'));
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
        
        $fitnessTest = $this->FitnessTests->get($id, [
            'contain' => ['Exercises']
        ]);

        $this->set('fitnessTest', $fitnessTest);
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
            $ids = $data['exercise_id'];
            $idl = $data['exercise_l'];
            $idr = $data['exerciser'];
            //$idt = $data['exercisert'];
            $user_id = $this->usersdetail['users_id'];
//            pr($ids);
//            pr($idr);
//          pr($idl); die;
           $i=0;  
            foreach ($ids as $id)
            {
               // pr($value);
                $fitnessTest = $this->FitnessTests->newEntity();
                $data1['exercise_id'] = $id;
                pr($data1['exercise_id']);
                $data1['status'] = 1;
                $data1['user_id'] = $user_id;
                $data2['exercise_left'] = $idl[$id];
                $data2['exercise_right'] = $idr[$id];
                //$data2['exercise_top'] = $idt[$id];
                $data1['exercise_type'] = json_encode($data2);
               // pr($data1['excercie_type']);
                // die;
               
                $fitnessTest = $this->FitnessTests->patchEntity($fitnessTest, $data1);
                //pr($fitnessTest); die;
            if ($this->FitnessTests->save($fitnessTest)) {
              $i++;  
           }
           //  pr($data1); 
          
                
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
            if ($this->FitnessTests->save($fitnessTest)) {
                $this->Flash->success(__('The fitness type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fitness type could not be saved. Please, try again.'));
        }
        $exercises = $this->FitnessTests->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('fitnessTest', 'exercises'));
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
