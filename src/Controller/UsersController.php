<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use finfo;
use Laminas\Diactoros\UploadedFile;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Before filter callback
     *
     * @param \Cake\Event\EventInterface $event Event instance.
     * @return \Cake\Http\Response|null|void
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // Quick fix: allow login & add without login
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();

        // Handle search with proper CakePHP Query Builder and input validation
        $search = $this->request->getQuery('search');
        if (!empty($search)) {
            // Validate and sanitize search input
            $search = trim($search);
            $searchLength = strlen($search);

            // Validate search length (3-100 characters)
            if ($searchLength < 3 || $searchLength > 100) {
                $this->Flash->error(__('Carian mesti antara 3 hingga 100 aksara.'));
                $search = ''; // Clear search to prevent invalid query
            } else {
                // Remove potentially dangerous characters
                $search = preg_replace('/[^\w\s\-\.@]/', '', $search);

                // Use CakePHP's Query Builder with proper binding
                $query->where([
                    'OR' => [
                        'Users.username LIKE' => '%' . $search . '%',
                        'Users.full_name LIKE' => '%' . $search . '%',
                        'Users.ic_number LIKE' => '%' . $search . '%',
                        'Users.email LIKE' => '%' . $search . '%',
                    ],
                ]);
            }
        }

        $users = $this->paginate($query);
        $this->set(compact('users', 'search'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view or redirects
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $authUser = $this->getRequest()->getSession()->read('Auth');
        $isAdmin = $authUser && isset($authUser->role) && $authUser->role === 'admin';

        // Authorization check: users can only view their own profile, admins can view any
        if (!$authUser) {
            $this->Flash->error(__('Sila log masuk terlebih dahulu.'));

            return $this->redirect(['action' => 'login']);
        }

        // Admin can view any user, regular users can only view themselves
        if (!$isAdmin && $authUser->user_type !== 'officer' && $authUser->id != $id) {
            $this->Flash->error(__('Anda tidak dibenarkan melihat profil pengguna lain.'));

            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->get($id);
        // Hide password from view
        $user->password = '';
        $this->set(compact('user', 'isAdmin'));
    }

    /**
     * Profile method - for users to edit their own information
     *
     * @return \Cake\Http\Response|null|void Renders view or redirects
     */
    public function profile()
    {
        $authUser = $this->getRequest()->getSession()->read('Auth');

        // Only allow public users to access profile
        if (!$authUser || !isset($authUser->user_type) || $authUser->user_type !== 'public') {
            $this->Flash->error(__('Hanya pengguna awam boleh mengakses halaman profil.'));

            return $this->redirect(['action' => 'index']);
        }

        // Get current user
        $user = $this->Users->get($authUser->id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // If password is empty, don't update it
            if (empty($data['password'])) {
                unset($data['password']);
            }

            // Users cannot change their username or role
            unset($data['username']);
            unset($data['role']);
            unset($data['status']); // Users cannot change their own status

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                // Update session with new data
                $authUser->full_name = $user->full_name;
                $authUser->email = $user->email;
                $this->getRequest()->getSession()->write('Auth', $authUser);

                $this->Flash->success(__('Profil anda berjaya dikemaskini.'));

                return $this->redirect(['action' => 'profile']);
            } else {
                // Show validation errors
                $errors = $user->getErrors();
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

        // Hide password from view
        $user->password = '';
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view or redirects
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            // If password is empty, don't update it
            if (empty($data['password'])) {
                unset($data['password']);
            }
            // Remove role if present (users table doesn't have role field)
            unset($data['role']);
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Maklumat user berjaya dikemaskini.'));

                return $this->redirect(['action' => 'index']);
            } else {
                // Show validation errors
                $errors = $user->getErrors();
                if (!empty($errors)) {
                    foreach ($errors as $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $this->Flash->error($error);
                        }
                    }
                } else {
                    $this->Flash->error(__('Gagal kemaskini user. Sila cuba lagi.'));
                }
            }
        }
        // Hide password from view
        $user->password = '';
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $authUser = $this->getRequest()->getSession()->read('Auth');
        $isAdmin = $authUser && isset($authUser->role) && $authUser->role === 'admin';

        // Authorization check: only admins can delete users
        if (!$authUser || !$isAdmin) {
            $this->Flash->error(__('Hanya admin dibenarkan memadam pengguna.'));

            return $this->redirect(['action' => 'index']);
        }

        // Prevent self-deletion
        if ($authUser->id == $id) {
            $this->Flash->error(__('Anda tidak boleh memadam akaun anda sendiri.'));

            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('User telah dipadam.'));
        } else {
            $this->Flash->error(__('Gagal padam user.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Renders view or redirects
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Input validation
            if (empty($data['username']) || empty($data['password'])) {
                $this->Flash->error(__('Kelayakan tidak sah. Sila cuba lagi.'));

                return $this->redirect(['action' => 'login']);
            }

            // Validate username format (alphanumeric and underscore, 3-50 characters)
            if (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $data['username'])) {
                $this->Flash->error(__('Kelayakan tidak sah. Sila cuba lagi.'));

                return $this->redirect(['action' => 'login']);
            }

            // Validate password length (minimum 6 characters)
            if (strlen($data['password']) < 6) {
                $this->Flash->error(__('Kelayakan tidak sah. Sila cuba lagi.'));

                return $this->redirect(['action' => 'login']);
            }

            // Special check for 'admin' username
            if ($data['username'] === 'admin') {
                // Always check officers table for admin user
                $officersTable = $this->fetchTable('Officers');
                $officer = $officersTable->find()
                    ->where(['username' => 'admin'])
                    ->first();
                
                if ($officer && password_verify($data['password'], $officer->password)) {
                    // Debug: Show officer data
                    debug('Admin officer found:', $officer);
                    
                    // Regenerate session ID to prevent session fixation
                    $session = $this->getRequest()->getSession();
                    $session->renew();

                    // Store admin session data
                    $authData = [
                        'id' => $officer->officer_id,
                        'username' => $officer->username,
                        'role' => 'admin', // Force admin role
                        'full_name' => $officer->full_name,
                        'staff_id' => $officer->staff_id,
                        'user_type' => 'officer', // Indicates came from officers table
                        'login_time' => time(),
                    ];
                    
                    // Debug: Show session data
                    debug('Admin session data:', $authData);
                    
                    $session->write('Auth', (object)$authData);

                    // Set admin status based on username
                    $isAdmin = ($data['username'] === 'admin');
                    $session->write('User.is_admin', $isAdmin);

                    // Redirect to Admin Dashboard
                    return $this->redirect(['controller' => 'Complaints', 'action' => 'index']);
                } else {
                    $this->Flash->error(__('Kelayakan tidak sah. Sila cuba lagi.'));
                    return $this->redirect(['action' => 'login']);
                }
            }

            // First check Officers table (admin/officer staff)
            $officersTable = $this->fetchTable('Officers');
            $officer = $officersTable->find()
                ->where(['username' => $data['username']])
                ->first();

            if ($officer) {
                // Found in officers table (admin/officer staff)
                if (password_verify($data['password'], $officer->password)) {
                    // Regenerate session ID to prevent session fixation
                    $session = $this->getRequest()->getSession();
                    $session->renew();

                    // Store officer session data
                    $authData = [
                        'id' => $officer->officer_id,
                        'username' => $officer->username,
                        'role' => $officer->role, // 'admin' or 'officer'
                        'full_name' => $officer->full_name,
                        'staff_id' => $officer->staff_id,
                        'user_type' => 'officer',
                        'is_admin' => false, // Regular officer, not admin
                        'login_time' => time(),
                    ];
                    $session->write('Auth', (object)$authData);

                    // Set admin status based on username
                    $isAdmin = ($data['username'] === 'admin');
                    $session->write('User.is_admin', $isAdmin);

                    // Redirect to Officer Dashboard
                    return $this->redirect(['controller' => 'Complaints', 'action' => 'index']);
                } else {
                    $this->Flash->error(__('Kelayakan tidak sah. Sila cuba lagi.'));
                }
            } else {
                // Check Users table (public users)
                $user = $this->Users->find()
                    ->where(['username' => $data['username']])
                    ->first();

                if ($user) {
                    if (password_verify($data['password'], $user->password)) {
                        // Regenerate session ID to prevent session fixation
                        $session = $this->getRequest()->getSession();
                        $session->renew();

                        // Store public user session data
                        $authData = [
                            'id' => $user->user_id,
                            'username' => $user->username,
                            'full_name' => $user->full_name,
                            'ic_number' => $user->ic_number,
                            'email' => $user->email,
                            'phone_mobile' => $user->phone_mobile,
                            'user_type' => 'public',
                            'is_admin' => false, // Public users are not admin
                            'login_time' => time(),
                        ];
                        $session->write('Auth', (object)$authData);

                        // Set admin status based on username
                        $isAdmin = ($data['username'] === 'admin');
                        $session->write('User.is_admin', $isAdmin);

                        // Redirect to Public User Dashboard
                        return $this->redirect(['controller' => 'Users', 'action' => 'profile']);
                    } else {
                        $this->Flash->error(__('Kelayakan tidak sah. Sila cuba lagi.'));
                    }
                } else {
                    $this->Flash->error(__('Kelayakan tidak sah. Sila cuba lagi.'));
                }
            }
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null Redirects to login
     */
    public function logout()
    {
        $this->getRequest()->getSession()->delete('Auth');
        $this->Flash->success(__('Anda telah log keluar.'));

        return $this->redirect(['action' => 'login']);
    }

    /**
     * Forgot Password - Allow users to reset password via email
     */
    public function forgotPassword()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');

            if (empty($email)) {
                $this->Flash->error(__('Sila masukkan alamat e-mel anda.'));

                return;
            }

            // Find user by email
            $user = $this->Users->find()
                ->where(['email' => $email])
                ->first();

            if ($user) {
                // Generate reset token (simple implementation)
                $resetToken = bin2hex(random_bytes(32));
                $user->reset_token = $resetToken;
                $user->reset_token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                if ($this->Users->save($user)) {
                    // In production, send email with reset link
                    // For now, show success message
                    $this->Flash->success(__(
                        'Arahan untuk menetapkan semula kata laluan telah dihantar ke e-mel anda.',
                    ));

                    return $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error(__('Ralat berlaku. Sila cuba lagi.'));
                }
            } else {
                $this->Flash->error(__('E-mel tidak dijumpai dalam sistem.'));
            }
        }
    }

    /**
     * Reset Password - Process password reset
     *
     * @param string|null $token Reset token.
     * @return \Cake\Http\Response|null|void Renders view or redirects
     */
    public function resetPassword(?string $token = null)
    {
        if (empty($token)) {
            $this->Flash->error(__('Token tidak sah.'));

            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Users->find()
            ->where(['reset_token' => $token])
            ->where(['reset_token_expiry >' => date('Y-m-d H:i:s')])
            ->first();

        if (!$user) {
            $this->Flash->error(__('Token tidak sah atau telah tamat tempoh.'));

            return $this->redirect(['action' => 'login']);
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            if (empty($data['password']) || $data['password'] !== $data['confirm_password']) {
                $this->Flash->error(__('Kata laluan tidak sepadan.'));
                $this->set(compact('user', 'token'));

                return;
            }

            $user->password = $data['password'];
            $user->reset_token = null;
            $user->reset_token_expiry = null;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Kata laluan anda telah berjaya ditetapkan semula. Sila log masuk.'));

                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Gagal menetapkan semula kata laluan. Sila cuba lagi.'));
            }
        }

        $this->set(compact('user', 'token'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Renders view or redirects
     */
    public function add()
    {
        $authUser = $this->getRequest()->getSession()->read('Auth');
        $isAdmin = $authUser && $authUser->role === 'admin';

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Server-side validation rules
            $errors = [];

            // Validate username
            if (empty($data['username'])) {
                $errors['username'] = __('Nama pengguna diperlukan.');
            } elseif (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $data['username'])) {
                $errors['username'] = __('Nama pengguna mesti 3-50 aksara alphanumeric dan underscore sahaja.');
            }

            // Validate full name
            if (empty($data['full_name'])) {
                $errors['full_name'] = __('Nama penuh diperlukan.');
            } elseif (strlen($data['full_name']) > 100) {
                $errors['full_name'] = __('Nama penuh tidak boleh melebihi 100 aksara.');
            } elseif (!preg_match('/^[a-zA-Z\s\-\.\']+$/', $data['full_name'])) {
                $errors['full_name'] = __('Nama penuh mengandungi aksara tidak sah.');
            }

            // Validate IC number
            if (empty($data['ic_number'])) {
                $errors['ic_number'] = __('No. KP diperlukan.');
            } elseif (!preg_match('/^[0-9]{12}$/', $data['ic_number'])) {
                $errors['ic_number'] = __('No. KP mesti 12 digit.');
            }

            // Validate email
            if (empty($data['email'])) {
                $errors['email'] = __('E-mel diperlukan.');
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = __('Format e-mel tidak sah.');
            } elseif (strlen($data['email']) > 255) {
                $errors['email'] = __('E-mel terlalu panjang.');
            }

            // Validate phone
            if (!empty($data['phone_mobile'])) {
                if (!preg_match('/^[0-9\-\+\s]{10,15}$/', $data['phone_mobile'])) {
                    $errors['phone_mobile'] = __('No. telefon tidak sah.');
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $errors['password'] = __('Kata laluan diperlukan.');
            } elseif (strlen($data['password']) < 8) {
                $errors['password'] = __('Kata laluan mesti sekurang-kurangnya 8 aksara.');
            } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $data['password'])) {
                $errors['password'] = __('Kata laluan mesti mengandungi huruf besar, huruf kecil, dan nombor.');
            }

            // Handle file upload with security validation
            if (isset($data['profile_image']) && $data['profile_image'] instanceof UploadedFile) {
                $uploadedFile = $data['profile_image'];

                // Validate file size (2MB limit)
                if ($uploadedFile->getSize() > 2 * 1024 * 1024) {
                    $errors['profile_image'] = __('Saiz fail terlalu besar. Maksimum 2MB.');
                } elseif ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
                    $errors['profile_image'] = __('Ralat memuat naik fail.');
                } else {
                    // Validate MIME type (images only)
                    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    $finfo = new finfo(FILEINFO_MIME_TYPE);
                    $mimeType = $finfo->file($uploadedFile->getStream()->getMetadata('uri'));

                    if (!in_array($mimeType, $allowedMimeTypes)) {
                        $errors['profile_image'] = __(
                            'Jenis fail tidak dibenarkan. Hanya gambar (JPEG, PNG, GIF, WebP) dibenarkan.',
                        );
                    } else {
                        // Secure file upload
                        $uploadDir = WWW_ROOT . 'uploads' . DS . 'profiles' . DS;
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }

                        // Generate secure filename
                        $ext = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
                        $fileName = 'profile_' . time() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
                        $filePath = $uploadDir . $fileName;

                        if ($uploadedFile->moveTo($filePath)) {
                            $data['profile_image_path'] = 'uploads/profiles/' . $fileName;
                        } else {
                            $errors['profile_image'] = __('Gagal menyimpan fail.');
                        }
                    }
                }

                // Remove the file object from data array
                unset($data['profile_image']);
            }

            // If validation errors, return with errors
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    $this->Flash->error($error);
                }
                $this->set(compact('user', 'errors'));

                return;
            }

            // Set default role to 'user' and status to 'active' for public users
            $data['role'] = 'user';
            if (!$isAdmin) {
                $data['status'] = 'active';
            }

            // Remove role from data if present (users table doesn't have role field)
            unset($data['role']);

            // Additional data sanitization
            $data['username'] = trim($data['username']);
            $data['full_name'] = trim($data['full_name']);
            $data['email'] = strtolower(trim($data['email']));
            $data['ic_number'] = trim($data['ic_number']);

            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->save($user)) {
                if (!$isAdmin) {
                    // Auto-login public users after registration
                    $authData = [
                        'id' => $user->user_id,
                        'username' => $user->username,
                        'full_name' => $user->full_name,
                        'ic_number' => $user->ic_number,
                        'email' => $user->email,
                        'phone_mobile' => $user->phone_mobile,
                        'user_type' => 'public',
                        'is_admin' => false,
                        'login_time' => time(),
                    ];
                    $this->getRequest()->getSession()->write('Auth', (object)$authData);
                    $this->Flash->success(__('Pendaftaran berjaya! Anda telah log masuk secara automatik.'));

                    return $this->redirect(['controller' => 'Complaints', 'action' => 'index']);
                } else {
                    $this->Flash->success(__('Pengguna berjaya ditambah.'));

                    return $this->redirect(['action' => 'index']);
                }
            } else {
                // Show validation errors
                $errors = $user->getErrors();
                if (!empty($errors)) {
                    foreach ($errors as $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $this->Flash->error($error);
                        }
                    }
                } else {
                    $this->Flash->error(__('Gagal menambah pengguna. Sila cuba lagi.'));
                }
            }
        }
        $this->set(compact('user'));
    }
}
