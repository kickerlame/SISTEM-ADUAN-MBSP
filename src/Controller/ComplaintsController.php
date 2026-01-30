<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Complaints Controller
 *
 * @property \App\Model\Table\ComplaintsTable $Complaints
 * @method \App\Model\Entity\Complaint[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComplaintsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Complaints->find()
            ->contain(['Complainants', 'Categories', 'Statuses', 'Priorities', 'Officers']);

        $authUser = $this->getRequest()->getSession()->read('Auth');
        if ($authUser && isset($authUser->user_type) && $authUser->user_type === 'public') {
            $query->innerJoinWith('Complainants', function ($q) use ($authUser) {
                return $q->where(['Complainants.ic_number' => $authUser->ic_number]);
            });
        }

        $complaints = $this->paginate($query);

        $totalComplaints = count($complaints);
        
        $inProgress = 0;
        $completed = 0;
        $pending = 0;
        
        foreach ($complaints as $complaint) {
            $statusId = $complaint->status_id;
            if ($statusId == 4) {
                $inProgress++;
            } elseif ($statusId == 1) {
                $completed++;
            } elseif ($statusId == 2) {
                $pending++;
            }
        }

        $this->set(compact('complaints', 'totalComplaints', 'inProgress', 'completed', 'pending'));
    }

    /**
     * View method
     *
     * @param string|null $id Complaint id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $complaint = $this->Complaints->get($id, [
            'contain' => ['Complainants', 'Categories', 'Statuses', 'Priorities', 'Officers'],
        ]);

        $this->set(compact('complaint'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $complaint = $this->Complaints->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            $authUser = $this->getRequest()->getSession()->read('Auth');
            
            if ($authUser && isset($authUser->user_type) && $authUser->user_type === 'public') {
                $complainantsTable = $this->fetchTable('Complainants');
                $complainant_record = $complainantsTable->find()
                    ->where(['ic_number' => $authUser->ic_number])
                    ->first();
                
                if ($complainant_record) {
                    $data['complainant_id'] = $complainant_record->complainant_id;
                } else {
                    $newComplainant = $complainantsTable->newEmptyEntity();
                    $newComplainant = $complainantsTable->patchEntity($newComplainant, [
                        'full_name' => $authUser->full_name,
                        'ic_number' => $authUser->ic_number,
                        'phone_mobile' => $authUser->phone_mobile ?? '',
                        'email' => $authUser->email ?? ''
                    ]);
                    
                    if ($complainantsTable->save($newComplainant)) {
                        $data['complainant_id'] = $newComplainant->complainant_id;
                    } else {
                        $this->Flash->error(__('Gagal membuat profil pengadu. Sila cuba lagi.'));
                        $this->set(compact('complaint'));
                        return;
                    }
                }
            }
            
            if (empty($data['complaint_no'])) {
                $data['complaint_no'] = 'MBSP-' . time();
            }
            
            if (empty($data['status_id'])) {
                $data['status_id'] = 2;
            }
            
            $complaint = $this->Complaints->patchEntity($complaint, $data);
            
            if ($this->Complaints->save($complaint)) {
                $this->Flash->success(__('Aduan berjaya disimpan.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $errors = $complaint->getErrors();
                foreach ($errors as $field => $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        $this->Flash->error($error);
                    }
                }
            }
            $this->Flash->error(__('Aduan tidak dapat disimpan. Sila cuba lagi.'));
        }
        $complainants = $this->Complaints->Complainants->find('list', ['limit' => 200])->all();
        $categories = $this->Complaints->Categories->find('list', ['limit' => 200])->all();
        $statuses = $this->Complaints->Statuses->find('list', ['limit' => 200])->all();
        $priorities = $this->Complaints->Priorities->find('list', ['limit' => 200])->all();
        $officers = $this->Complaints->Officers->find('list', ['limit' => 200])->all();
        
        $districts = [
            'SPU' => 'Seberang Perai Utara',
            'SPT' => 'Seberang Perai Tengah', 
            'SPS' => 'Seberang Perai Selatan'
        ];
        
        $this->set(compact('complaint', 'complainants', 'categories', 'statuses', 'priorities', 'officers', 'districts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Complaint id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $complaint = $this->Complaints->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $complaint = $this->Complaints->patchEntity($complaint, $this->request->getData());
            if ($this->Complaints->save($complaint)) {
                $this->Flash->success(__('The complaint has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint could not be saved. Please, try again.'));
        }
        $complainants = $this->Complaints->Complainants->find('list', ['limit' => 200])->all();
        $categories = $this->Complaints->Categories->find('list', ['limit' => 200])->all();
        $statuses = $this->Complaints->Statuses->find('list', ['limit' => 200])->all();
        $priorities = $this->Complaints->Priorities->find('list', ['limit' => 200])->all();
        $officers = $this->Complaints->Officers->find('list', ['limit' => 200])->all();
        $this->set(compact('complaint', 'complainants', 'categories', 'statuses', 'priorities', 'officers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Complaint id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $complaint = $this->Complaints->get($id);
        if ($this->Complaints->delete($complaint)) {
            $this->Flash->success(__('The complaint has been deleted.'));
        } else {
            $this->Flash->error(__('The complaint could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
