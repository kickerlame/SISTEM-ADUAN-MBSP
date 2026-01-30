<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Sistem Pengurusan Aduan MBSP';
$authUser = $this->getRequest()->getSession()->read('Auth');
$currentAction = $this->request->getParam('action');
$currentController = $this->request->getParam('controller');
$isIndexPage = ($currentController === 'Complaints' && $currentAction === 'index') || 
               ($currentController === 'Pages' && $currentAction === 'display');
$isLoginPage = ($currentController === 'Users' && in_array($currentAction, ['login', 'forgotPassword']));
$isHomePage = ($currentController === 'Pages');

// Safety check: default user_type to 'public' if not set
$userType = 'public';
$isAdmin = false;
if ($authUser && isset($authUser->user_type)) {
    $userType = $authUser->user_type;
    // Admin is either user_type 'admin' or 'officer' (officers can be admin)
    $isAdmin = ($userType === 'officer') || (isset($authUser->role) && $authUser->role === 'admin');
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?= $this->Html->css('theme-premium') ?>
    <?php if ($isHomePage): ?>
        <?= $this->Html->css('home-government') ?>
    <?php endif; ?>
    
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="<?= trim(($isLoginPage ? 'login-page' : '') . ' ' . ($isHomePage ? 'home-page' : '')) ?>">
    <div class="sidebar">
        <a href="<?= $this->Url->build('/') ?>" class="sidebar-brand">
            <i class="fas fa-landmark"></i>
            <span>SISTEM ADUAN MBSP</span>
        </a>
        
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="<?= $this->Url->build('/') ?>" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Halaman Utama</span>
                </a>
            </div>
            <?php if ($authUser): ?>
                <div class="nav-item">
                    <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'index']) ?>" class="nav-link">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Aduan Dashboard</span>
                    </a>
                </div>
                <?php if ($userType === 'public'): ?>
                    <div class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'add']) ?>" class="nav-link">
                            <i class="fas fa-plus-circle"></i>
                            <span>Buat Aduan</span>
                        </a>
                    </div>
                    
                    <div class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>" class="nav-link">
                            <i class="fas fa-user"></i>
                            <span>Profil</span>
                        </a>
                    </div>
                <?php elseif ($isAdmin): ?>
                    <div class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'add']) ?>" class="nav-link">
                            <i class="fas fa-plus-circle"></i>
                            <span>Buat Aduan</span>
                        </a>
                    </div>
                    <div class="nav-divider"></div>
                    <div class="nav-section-title">PENTADBIR</div>
                    <div class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Pengguna</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'Officers', 'action' => 'index']) ?>" class="nav-link">
                            <i class="fas fa-user-shield"></i>
                            <span>Pegawai</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'index']) ?>" class="nav-link">
                            <i class="fas fa-building"></i>
                            <span>Jabatan</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'ComplaintCategories', 'action' => 'index']) ?>" class="nav-link">
                            <i class="fas fa-tags"></i>
                            <span>Kategori</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'Officers', 'action' => 'profile']) ?>" class="nav-link">
                            <i class="fas fa-user-cog"></i>
                            <span>Profil Pentadbir</span>
                        </a>
                    </div>
                <?php elseif ($userType === 'officer'): ?>
                    <div class="nav-item">
                        <a href="<?= $this->Url->build(['controller' => 'Officers', 'action' => 'profile']) ?>" class="nav-link">
                            <i class="fas fa-user-cog"></i>
                            <span>Profil Pegawai</span>
                        </a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="nav-item">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Log Masuk</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        <span>Daftar</span>
                    </a>
                </div>
            <?php endif; ?>
        </nav>
        
        <?php if ($authUser): ?>
            <div class="sidebar-footer">
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="nav-link logout-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Keluar</span>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="main-content">
        <div class="topbar">
            <?php if ($authUser): ?>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>" class="user-profile">
                    <div class="user-avatar">
                        <?= strtoupper(substr($authUser->username, 0, 1)) ?>
                    </div>
                    <span><?= h($authUser->username) ?></span>
                    <span class="user-role">
                        <?php if ($userType === 'officer'): ?>
                            <?= (isset($authUser->role) && $authUser->role === 'admin') ? 'Pentadbir' : 'Pegawai' ?>
                        <?php elseif ($userType === 'public'): ?>
                            Pengguna
                        <?php else: ?>
                            Pentadbir
                        <?php endif; ?>
                    </span>
                </a>
            <?php endif; ?>
        </div>

        <div class="content-area">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </div>

    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Hubungi Kami</h4>
                <p>Tel: 04-539 9999<br>E-mel: info@mbsp.gov.my</p>
            </div>
            <div class="footer-section">
                <h4>Waktu Operasi</h4>
                <p>Isnin - Jumaat: 8:00 AM - 5:00 PM<br>Sabtu: 8:00 AM - 1:00 PM</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> Majlis Bandaraya Seberang Perai. Hak Cipta Terpelihara.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->fetch('scriptBottom') ?>

    <script>
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;
            
            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    element.textContent = Math.ceil(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target;
                }
            };
            
            updateCounter();
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.stat-number[data-target]');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            });
            
            counters.forEach(counter => {
                observer.observe(counter);
            });
            
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const topbar = document.querySelector('.topbar');
            
            if (window.innerWidth <= 768) {
                const toggleBtn = document.createElement('button');
                toggleBtn.className = 'sidebar-toggle';
                toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
                toggleBtn.style.cssText = `
                    position: fixed;
                    top: 20px;
                    left: 20px;
                    z-index: 1001;
                    background: var(--navy-gradient);
                    color: white;
                    border: none;
                    border-radius: 10px;
                    padding: 10px;
                    cursor: pointer;
                    box-shadow: var(--glass-shadow);
                `;
                
                document.body.appendChild(toggleBtn);
                
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('show');
                });
                
                document.addEventListener('click', (e) => {
                    if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                });
            }
            
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!document.body.classList.contains('login-page')) {
                return;
            }

            const passwordInputs = document.querySelectorAll('input[type="password"]');
            passwordInputs.forEach(function(input) {
                if (input.closest('.password-wrapper')) {
                    return;
                }

                const wrapper = document.createElement('div');
                wrapper.className = 'password-wrapper';

                const toggleBtn = document.createElement('button');
                toggleBtn.type = 'button';
                toggleBtn.className = 'password-toggle-btn';
                toggleBtn.innerHTML = '<i class="fa-solid fa-eye"></i>';
                toggleBtn.setAttribute('aria-label', 'Tunjukkan/Sembunyikan kata laluan');
                toggleBtn.setAttribute('title', 'Tunjukkan/Sembunyikan kata laluan');
                
                input.parentNode.insertBefore(wrapper, input);
                wrapper.appendChild(input);

                wrapper.appendChild(toggleBtn);

                toggleBtn.addEventListener('click', function() {
                    if (input.type === 'password') {
                        input.type = 'text';
                        toggleBtn.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
                    } else {
                        input.type = 'password';
                        toggleBtn.innerHTML = '<i class="fa-solid fa-eye"></i>';
                    }
                });
            });
        });
    </script>
</body>
</html>
