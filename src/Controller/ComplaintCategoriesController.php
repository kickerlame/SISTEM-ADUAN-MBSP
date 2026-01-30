<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ComplaintCategories Controller
 *
 * @property \App\Model\Table\ComplaintCategoriesTable $ComplaintCategories
 */
class ComplaintCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ComplaintCategories->find();
        $search = $this->request->getQuery('search');
        if (!empty($search)) {
            $query->where([
                'ComplaintCategories.category_name LIKE' => '%' . $search . '%',
            ]);
        }
        $complaintCategories = $this->paginate($query);

        $this->set(compact('complaintCategories', 'search'));
    }

    /**
     * View method
     *
     * @param string|null $id Complaint Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $complaintCategory = $this->ComplaintCategories->get($id, contain: []);
        $this->set(compact('complaintCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $complaintCategory = $this->ComplaintCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $complaintCategory = $this->ComplaintCategories->patchEntity(
                $complaintCategory,
                $this->request->getData(),
            );
            if ($this->ComplaintCategories->save($complaintCategory)) {
                $this->Flash->success(__('The complaint category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint category could not be saved. Please, try again.'));
        }
        $departments = $this->ComplaintCategories->Departments->find('list', limit: 200)->all();
        $this->set(compact('complaintCategory', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Complaint Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $complaintCategory = $this->ComplaintCategories->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $complaintCategory = $this->ComplaintCategories->patchEntity(
                $complaintCategory,
                $this->request->getData(),
            );
            if ($this->ComplaintCategories->save($complaintCategory)) {
                $this->Flash->success(__('The complaint category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint category could not be saved. Please, try again.'));
        }
        $departments = $this->ComplaintCategories->Departments->find('list', limit: 200)->all();
        $this->set(compact('complaintCategory', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Complaint Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $complaintCategory = $this->ComplaintCategories->get($id);
        if ($this->ComplaintCategories->delete($complaintCategory)) {
            $this->Flash->success(__('The complaint category has been deleted.'));
        } else {
            $this->Flash->error(__('The complaint category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
