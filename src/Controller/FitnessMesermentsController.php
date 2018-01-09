<?php
namespace App\Controller;

use App\Controller\AppController;

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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $fitnessMeserments = $this->paginate($this->FitnessMeserments);

        $this->set(compact('fitnessMeserments'));
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
        $fitnessMeserment = $this->FitnessMeserments->get($id, [
            'contain' => ['Users']
        ]);

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
        $fitnessMeserment = $this->FitnessMeserments->newEntity();
        if ($this->request->is('post')) {
            $fitnessMeserment = $this->FitnessMeserments->patchEntity($fitnessMeserment, $this->request->getData());
            if ($this->FitnessMeserments->save($fitnessMeserment)) {
                $this->Flash->success(__('The fitness meserment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fitness meserment could not be saved. Please, try again.'));
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
        $fitnessMeserment = $this->FitnessMeserments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fitnessMeserment = $this->FitnessMeserments->patchEntity($fitnessMeserment, $this->request->getData());
            if ($this->FitnessMeserments->save($fitnessMeserment)) {
                $this->Flash->success(__('The fitness meserment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fitness meserment could not be saved. Please, try again.'));
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
        $this->request->allowMethod(['post', 'delete']);
        $fitnessMeserment = $this->FitnessMeserments->get($id);
        if ($this->FitnessMeserments->delete($fitnessMeserment)) {
            $this->Flash->success(__('The fitness meserment has been deleted.'));
        } else {
            $this->Flash->error(__('The fitness meserment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
