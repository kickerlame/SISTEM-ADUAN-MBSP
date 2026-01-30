<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * RefPriority Controller
 *
 * @property \App\Model\Table\RefPriorityTable $RefPriority
 */
class RefPriorityController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->RefPriority->find();
        $refPriority = $this->paginate($query);

        $this->set(compact('refPriority'));
    }

    /**
     * View method
     *
     * @param string|null $id Ref Priority id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $refPriority = $this->RefPriority->get($id, contain: []);
        $this->set(compact('refPriority'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $refPriority = $this->RefPriority->newEmptyEntity();
        if ($this->request->is('post')) {
            $refPriority = $this->RefPriority->patchEntity($refPriority, $this->request->getData());
            if ($this->RefPriority->save($refPriority)) {
                $this->Flash->success(__('The ref priority has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ref priority could not be saved. Please, try again.'));
        }
        $this->set(compact('refPriority'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ref Priority id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $refPriority = $this->RefPriority->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $refPriority = $this->RefPriority->patchEntity($refPriority, $this->request->getData());
            if ($this->RefPriority->save($refPriority)) {
                $this->Flash->success(__('The ref priority has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ref priority could not be saved. Please, try again.'));
        }
        $this->set(compact('refPriority'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ref Priority id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $refPriority = $this->RefPriority->get($id);
        if ($this->RefPriority->delete($refPriority)) {
            $this->Flash->success(__('The ref priority has been deleted.'));
        } else {
            $this->Flash->error(__('The ref priority could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
