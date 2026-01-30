<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Officers Controller
 *
 * @property \App\Model\Table\OfficersTable $Officers
 */
class OfficersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Officers->find()
            ->contain(['Departments']);

        $search = $this->request->getQuery('search');
        if (!empty($search)) {
            $query->where([
                'OR' => [
                    'Officers.username LIKE' => '%' . $search . '%',
                    'Officers.full_name LIKE' => '%' . $search . '%',
                    'Officers.staff_id LIKE' => '%' . $search . '%',
                    'Departments.department_name LIKE' => '%' . $search . '%',
                ],
            ]);
        }

        $officers = $this->paginate($query);
        $this->set(compact('officers', 'search'));
    }

    /**
     * View method
     *
     * @param string|null $id Officer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $officer = $this->Officers->get($id, ['contain' => ['Departments']]);
        $this->set(compact('officer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $officer = $this->Officers->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if (empty($data['staff_id'])) {
                $lastOfficer = $this->Officers->find()
                    ->order(['officer_id' => 'DESC'])
                    ->first();
                $nextId = $lastOfficer ? $lastOfficer->officer_id + 1 : 1;
                $data['staff_id'] = 'OFF' . str_pad((string)$nextId, 6, '0', STR_PAD_LEFT);
            }

            if (empty($data['status'])) {
                $data['status'] = 'active';
            }

            $officer = $this->Officers->patchEntity($officer, $data);
            if ($this->Officers->save($officer)) {
                $this->Flash->success(__('Officer berjaya ditambah.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $errors = $officer->getErrors();
                if (!empty($errors)) {
                    foreach ($errors as $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $this->Flash->error($error);
                        }
                    }
                } else {
                    $this->Flash->error(__('Gagal menambah officer. Sila cuba lagi.'));
                }
            }
        }
        $departments = $this->Officers->Departments->find('list', ['limit' => 200])->all();
        $this->set(compact('officer', 'departments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Officer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $officer = $this->Officers->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if (empty($data['password'])) {
                unset($data['password']);
            }
            unset($data['staff_id']);
            $officer = $this->Officers->patchEntity($officer, $data);
            if ($this->Officers->save($officer)) {
                $this->Flash->success(__('Maklumat officer berjaya dikemaskini.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $errors = $officer->getErrors();
                if (!empty($errors)) {
                    foreach ($errors as $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $this->Flash->error($error);
                        }
                    }
                } else {
                    $this->Flash->error(__('Gagal mengemaskini officer. Sila cuba lagi.'));
                }
            }
        }
        $officer->password = '';
        $departments = $this->Officers->Departments->find('list', ['limit' => 200])->all();
        $this->set(compact('officer', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Officer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $officer = $this->Officers->get($id);
        if ($this->Officers->delete($officer)) {
            $this->Flash->success(__('Officer telah dipadam.'));
        } else {
            $this->Flash->error(__('Gagal memadam officer. Sila cuba lagi.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Profile method - for admin to edit their own profile
     *
     * @return \Cake\Http\Response|null|void Renders view or redirects
     */
    public function profile()
    {
        $authUser = $this->getRequest()->getSession()->read('Auth');

        if (!$authUser || $authUser->role !== 'admin') {
            $this->Flash->error(__('Hanya pentadbir boleh mengakses halaman profil pentadbir.'));

            return $this->redirect(['controller' => 'Complaints', 'action' => 'index']);
        }

        $officer = $this->Officers->get($authUser->id, ['contain' => ['Departments']]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            if (empty($data['password'])) {
                unset($data['password']);
            }

            unset($data['role']);
            unset($data['staff_id']);

            $officer = $this->Officers->patchEntity($officer, $data);
            if ($this->Officers->save($officer)) {
                $authUser->full_name = $officer->full_name;
                $authUser->username = $officer->username;
                $this->getRequest()->getSession()->write('Auth', $authUser);

                $this->Flash->success(__('Profil pentadbir berjaya dikemaskini.'));

                return $this->redirect(['action' => 'profile']);
            } else {
                $errors = $officer->getErrors();
                if (!empty($errors)) {
                    foreach ($errors as $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $this->Flash->error($error);
                        }
                    }
                } else {
                    $this->Flash->error(__('Gagal mengemaskini profil. Sila cuba lagi.'));
                }
            }
        }

        $officer->password = '';
        $departments = $this->Officers->Departments->find('list', ['limit' => 200])->all();
        $this->set(compact('officer', 'departments'));
    }
}
