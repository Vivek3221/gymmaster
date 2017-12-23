<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Bodies Controller
 *
 * @property \App\Model\Table\BodiesTable $Bodies
 *
 * @method \App\Model\Entity\Body[] paginate($object = null, array $settings = [])
 */
class BodiesController extends AppController
{
    public function initialize()
    {

        parent::initialize();
        $this->loadComponent('Flash'); 
    }
    
     public function beforeFilter(Event $event) {
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
        $bodies = $this->paginate($this->Bodies);

        $this->set(compact('bodies'));
        $this->set('_serialize', ['bodies']);
    }

    /**
     * View method
     *
     * @param string|null $id Body id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        
             if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $body = $this->Bodies->get($id, [
            'contain' => ['Exercise']
        ]);

        $this->set('body', $body);
        $this->set('_serialize', ['body']);
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
        $body = $this->Bodies->newEntity();
        if ($this->request->is('post')) {
            $body = $this->Bodies->patchEntity($body, $this->request->getData());
            if ($this->Bodies->save($body)) {
                $this->Flash->success(__('The body has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The body could not be saved. Please, try again.'));
        }
        $this->set(compact('body'));
        $this->set('_serialize', ['body']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Body id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
            if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $body = $this->Bodies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $body = $this->Bodies->patchEntity($body, $this->request->getData());
            if ($this->Bodies->save($body)) {
                $this->Flash->success(__('The body has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The body could not be saved. Please, try again.'));
        }
        $this->set(compact('body'));
        $this->set('_serialize', ['body']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Body id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
            if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        //$this->request->allowMethod(['post', 'delete']);
        $body = $this->Bodies->get($id);
        if ($this->Bodies->delete($body)) {
            $this->Flash->success(__('The body has been deleted.'));
        } else {
            $this->Flash->error(__('The body could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
     public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Admintheme');
    }
}
