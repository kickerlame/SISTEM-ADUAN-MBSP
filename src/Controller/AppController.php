<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
    }

    /**
     * Manual authentication check (Session-based)
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $controller = strtolower((string) $this->request->getParam('controller'));
        $action = strtolower((string) $this->request->getParam('action'));

        if ($controller === 'users' && $action === 'login') {
            return null;
        }

        $allowedActions = ['add', 'forgotpassword', 'resetpassword'];
        if ($controller === 'users' && in_array($action, $allowedActions)) {
            return null;
        }

        if ($controller === 'pages' && $action === 'display') {
            return null;
        }

        if ($controller === 'users' && $action === 'profile') {
            $authUser = $this->getRequest()->getSession()->read('Auth');
            if ($authUser && isset($authUser->user_type) && $authUser->user_type === 'public') {
                return null;
            }
            $this->Flash->error(__('Akses ditolak. Halaman ini hanya untuk admin.'));
            return $this->redirect(['controller' => 'Complaints', 'action' => 'index']);
        }

        if (!$this->getRequest()->getSession()->check('Auth')) {
            $this->Flash->error(__('Sila login terlebih dahulu.'));

            return $this->redirect([
                'controller' => 'Users',
                'action' => 'login',
            ]);
        }

        $authUser = $this->getRequest()->getSession()->read('Auth');

        if (isset($authUser->user_type) && $authUser->user_type === 'public') {
            if ($controller !== 'users' && $controller !== 'complaints') {
                $this->Flash->error(__('Akses ditolak. Halaman ini hanya untuk admin.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'profile']);
            }
        }

        return null;
    }

    /**
     * Before render callback
     *
     * @param \Cake\Event\EventInterface $event Event instance.
     * @return \Cake\Http\Response|null|void
     */
    public function beforeRender(EventInterface $event)
    {
        $isAdmin = $this->getRequest()->getSession()->read('User.is_admin') ?? false;
        $this->set('isAdmin', $isAdmin);

        return null;
    }
}
