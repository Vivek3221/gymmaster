<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * FitnessType Controller
 *
 * @property \App\Model\Table\FitnessTypeTable $FitnessType
 *
 * @method \App\Model\Entity\FitnessType[] paginate($object = null, array $settings = [])
 */
class FitnessTypeController extends AppController
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
        $fitnessType = $this->paginate($this->FitnessType);

        $this->set(compact('fitnessType'));
        $this->set('_serialize', ['fitnessType']);
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
        
        $fitnessType = $this->FitnessType->get($id, [
            'contain' => ['Exercises']
        ]);

        $this->set('fitnessType', $fitnessType);
        $this->set('_serialize', ['fitnessType']);
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
       $fitnessType = $this->FitnessType->newEntity();
        if ($this->request->is('post')) {
            $data1 =[];
            //$data2 =[];
            $data = $this->request->data;
            $ids = $data['exercise_id'];
            $idl = $data['exercise_l'];
            $idr = $data['exerciser'];
            
         // pr($ids); 
           $i=0;  
            foreach ($ids as $id)
            {
               // pr($value);
                  $fitnessType = $this->FitnessType->newEntity();
                $data1['exercise_id'] = $id;
                pr($data1['exercise_id']);
                $data1['status'] = 1;
                $data1['exercise_l'] = $idl[$id];
                $data1['exercise_r'] = $idr[$id];
                $data1['excercie_type'] = $data1['exercise_l'] . $data1['exercise_r'];
                //pr($data1['exercise_id']);
                //pr($data1['excercie_type']);
               
                $fitnessType = $this->FitnessType->patchEntity($fitnessType, $data1);
            if ($this->FitnessType->save($fitnessType)) {
              $i++;  
           }
           //  pr($data1); 
          
                
            }

          //die;
//            $fitnessType = $this->FitnessType->patchEntity($fitnessType, $data);
//            if ($this->FitnessType->save($fitnessType)) {
//                $this->Flash->success(__('The fitness type has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The fitness type could not be saved. Please, try again.'));
        }
        $exercises = $this->FitnessType->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('fitnessType', 'exercises'));
        $this->set('_serialize', ['fitnessType']);
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
        
        $fitnessType = $this->FitnessType->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fitnessType = $this->FitnessType->patchEntity($fitnessType, $this->request->getData());
            if ($this->FitnessType->save($fitnessType)) {
                $this->Flash->success(__('The fitness type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fitness type could not be saved. Please, try again.'));
        }
        $exercises = $this->FitnessType->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('fitnessType', 'exercises'));
        $this->set('_serialize', ['fitnessType']);
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
        $fitnessType = $this->FitnessType->get($id);
        if ($this->FitnessType->delete($fitnessType)) {
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
