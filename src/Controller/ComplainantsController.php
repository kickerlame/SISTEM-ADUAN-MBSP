<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Complainants Controller
 *
 * @property \App\Model\Table\ComplainantsTable $Complainants
 */
class ComplainantsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Complainants->find();
        $complainants = $this->paginate($query);

        $this->set(compact('complainants'));
    }

    /**
     * View method
     *
     * @param string|null $id Complainant id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $complainant = $this->Complainants->get($id, contain: []);
        $this->set(compact('complainant'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // Only allow if not admin (admin should not add complainants manually)
        $authUser = $this->getRequest()->getSession()->read('Auth');
        if ($authUser && $authUser->role === 'admin') {
            $this->Flash->error(__('Admin tidak boleh menambah complainant secara manual.'));

            return $this->redirect(['action' => 'index']);
        }

        $complainant = $this->Complainants->newEmptyEntity();
        if ($this->request->is('post')) {
            $complainant = $this->Complainants->patchEntity($complainant, $this->request->getData());
            if ($this->Complainants->save($complainant)) {
                $this->Flash->success(__('Complainant berjaya disimpan.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Complainant tidak dapat disimpan. Sila cuba lagi.'));
        }

        $districts = [
            'Batu Pahat' => 'Batu Pahat',
            'Johor Bahru' => 'Johor Bahru',
            'Kluang' => 'Kluang',
            'Kota Tinggi' => 'Kota Tinggi',
            'Kulai' => 'Kulai',
            'Mersing' => 'Mersing',
            'Muar' => 'Muar',
            'Pontian' => 'Pontian',
            'Segamat' => 'Segamat',
            'Tangkak' => 'Tangkak',
        ];

        $this->set(compact('complainant', 'districts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Complainant id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $complainant = $this->Complainants->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $complainant = $this->Complainants->patchEntity($complainant, $this->request->getData());
            if ($this->Complainants->save($complainant)) {
                $this->Flash->success(__('Complainant berjaya dikemaskini.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Complainant tidak dapat dikemaskini. Sila cuba lagi.'));
        }

        $districts = [
            'Batu Pahat' => 'Batu Pahat',
            'Johor Bahru' => 'Johor Bahru',
            'Kluang' => 'Kluang',
            'Kota Tinggi' => 'Kota Tinggi',
            'Kulai' => 'Kulai',
            'Mersing' => 'Mersing',
            'Muar' => 'Muar',
            'Pontian' => 'Pontian',
            'Segamat' => 'Segamat',
            'Tangkak' => 'Tangkak',
        ];

        $this->set(compact('complainant', 'districts'));
    }

    /**
     * Delete method - DISABLED
     * Complainants cannot be deleted
     *
     * @param string|null $id Complainant id.
     * @return \Cake\Http\Response|null Redirects to index.
     */
    public function delete(?string $id = null)
    {
        $this->Flash->error(__('Fungsi padam tidak dibenarkan untuk rekod pengadu.'));

        return $this->redirect(['action' => 'index']);
    }
}
