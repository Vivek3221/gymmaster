<?php
namespace App\Controller;

use App\Controller\AppController;

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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Exercises']
        ];
        $fitnessTests = $this->paginate($this->FitnessTests);

        $this->set(compact('fitnessTests'));
        $this->set('_serialize', ['fitnessTests']);
    }

    /**
     * View method
     *
     * @param string|null $id Fitness Test id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fitnessTest = $this->FitnessTests->get($id, [
            'contain' => ['Users', 'Exercises']
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
        $fitnessTest = $this->FitnessTests->newEntity();
        if ($this->request->is('post')) {
            $fitnessTest = $this->FitnessTests->patchEntity($fitnessTest, $this->request->getData());
            if ($this->FitnessTests->save($fitnessTest)) {
                $this->Flash->success(__('The fitness test has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fitness test could not be saved. Please, try again.'));
        }
        $users = $this->FitnessTests->Users->find('list', ['limit' => 200]);
        $exercises = $this->FitnessTests->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('fitnessTest', 'users', 'exercises'));
        $this->set('_serialize', ['fitnessTest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fitness Test id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fitnessTest = $this->FitnessTests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fitnessTest = $this->FitnessTests->patchEntity($fitnessTest, $this->request->getData());
            if ($this->FitnessTests->save($fitnessTest)) {
                $this->Flash->success(__('The fitness test has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fitness test could not be saved. Please, try again.'));
        }
        $users = $this->FitnessTests->Users->find('list', ['limit' => 200]);
        $exercises = $this->FitnessTests->Exercises->find('list', ['limit' => 200]);
        $this->set(compact('fitnessTest', 'users', 'exercises'));
        $this->set('_serialize', ['fitnessTest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fitness Test id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fitnessTest = $this->FitnessTests->get($id);
        if ($this->FitnessTests->delete($fitnessTest)) {
            $this->Flash->success(__('The fitness test has been deleted.'));
        } else {
            $this->Flash->error(__('The fitness test could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
