<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ExrciseDirectories Controller
 *
 * @property \App\Model\Table\ExrciseDirectoriesTable $ExrciseDirectories
 *
 * @method \App\Model\Entity\ExrciseDirectory[] paginate($object = null, array $settings = [])
 */
class ExrciseDirectoriesController extends AppController
{

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
        $search = [];
        if (isset($this->request->query['name']) && trim($this->request->query['name']) != "") {
            $name = $this->request->query['name'];
            $search['ExrciseDirectories.name REGEXP'] = $name;
        }
         if (isset($this->request->query['status']) && trim($this->request->query['status']) != "") {
            $status = $this->request->query['status'];
            $search['ExrciseDirectories.status'] = $status;
        }
        if (isset($this->request->query['norec']) && trim($this->request->query['norec']) != "") {
            $norec = $this->request->query['norec'];
        }
        
        if (isset($search)) {
            $count = $this->ExrciseDirectories->find('all')
                    ->where([$search]);
        } else {
            $count = $this->ExrciseDirectories->find('all');
        }
        $count = $count->where(['ExrciseDirectories.status !=' => '2']);
        $this->paginate = [
            'limit' => $norec, 
            'order' => ['ExrciseDirectories.id' => 'DESC'],
            
        ];
        
        $exrciseDirectories = $this->paginate($count);

        $this->set(compact('exrciseDirectories','name','status','norec'));
        $this->set('_serialize', ['exrciseDirectories']);
    }

    /**
     * View method
     *
     * @param string|null $id Exrcise Directory id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
         if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $exrciseDirectory = $this->ExrciseDirectories->get($id, [
            'contain' => []
        ]);

        $this->set('exrciseDirectory', $exrciseDirectory);
        $this->set('_serialize', ['exrciseDirectory']);
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
        $exrciseDirectory = $this->ExrciseDirectories->newEntity();
        if ($this->request->is('post')) {
            $exrciseDirectory = $this->ExrciseDirectories->patchEntity($exrciseDirectory, $this->request->getData());
            if ($this->ExrciseDirectories->save($exrciseDirectory)) {
                $this->Flash->success(__('The exrcise directory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exrcise directory could not be saved. Please, try again.'));
        }
        $this->set(compact('exrciseDirectory'));
        $this->set('_serialize', ['exrciseDirectory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Exrcise Directory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
         if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $exrciseDirectory = $this->ExrciseDirectories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exrciseDirectory = $this->ExrciseDirectories->patchEntity($exrciseDirectory, $this->request->getData());
            if ($this->ExrciseDirectories->save($exrciseDirectory)) {
                $this->Flash->success(__('The exrcise directory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exrcise directory could not be saved. Please, try again.'));
        }
        $this->set(compact('exrciseDirectory'));
        $this->set('_serialize', ['exrciseDirectory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exrcise Directory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
         if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
       // $this->request->allowMethod(['post', 'delete']);
        $exrciseDirectory = $this->ExrciseDirectories->get($id);
        if ($this->ExrciseDirectories->delete($exrciseDirectory)) {
            $this->Flash->success(__('The exrcise directory has been deleted.'));
        } else {
            $this->Flash->error(__('The exrcise directory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
     public function status() {
                       if (empty($this->usersdetail['users_name']) || empty($this->usersdetail['users_email'])) {
            return $this->redirect('/');
        }
        $id = $this->request->params['pass'][0];
        $status = $this->request->params['pass'][1];
        $user = $this->ExrciseDirectories->get($id);
        if ($status == 1) {
            $user_data['status'] = 0;
            $user_data['id'] = $id;
            $user = $this->ExrciseDirectories->patchEntity($user, $user_data);
            if ($this->ExrciseDirectories->save($user)) {
                $st = $user_data['status'] ? '<span class="label label-success">' . __('Active') . '</span>' : '<span class="label label-danger">' . __('Inactive') . '</span>';
                // echo "<a href= '#' onclick = 'updateStatus(" . $id . "," . $user_data['status'] . ")'> " . $st . " </a>";
                echo '<button id=' . $id . ' class="btn btn-primary waves-effect status" value=' . $user_data['status'] . ' onclick="updateStatus(this.id,' . $user_data['status'] . ')" type="submit">Inactive</button>';
                exit;
            }
        } else {
            $user_data['status'] = 1;
            $user_data['id'] = $id;
            $user = $this->ExrciseDirectories->patchEntity($user, $user_data);
            if ($this->ExrciseDirectories->save($user)) {
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
