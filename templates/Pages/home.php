<?php
/**
 * MBSP Complaint Management System - Home Page
 * 
 * @var \App\View\AppView $this
 */

$this->assign('title', 'Halaman Utama');
?>

<style>
.hero-btn-gold {
    color: white;
    font-weight: 700;
    background-color: #f59e0b;
    border: 2px solid #f59e0b;
    transition: all 0.3s ease;
    display: inline-block;
}

.hero-btn-gold:hover {
    background-color: #d97706;
    border-color: #d97706;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
    color: white;
}

.hero-btn-light {
    color: #1f2937;
    font-weight: 700;
    background-color: white;
    border: 2px solid white;
    transition: all 0.3s ease;
    display: inline-block;
}

.hero-btn-light:hover {
    background-color: #f3f4f6;
    border-color: #f3f4f6;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 255, 255, 0.4);
    color: #1f2937;
}
</style>

<section class="hero-section" style="background: linear-gradient(135deg, rgba(30, 58, 138, 0.85) 0%, rgba(37, 99, 235, 0.85) 100%), url('<?= $this->Url->webroot('img/mbsp-building.jpg') ?>') center/cover no-repeat; background-attachment: fixed;">
    <div class="hero-content">
        <div class="hero-overlay">
            <h1 class="hero-title">Selamat Datang ke Sistem Aduan MBSP</h1>
            <p class="hero-description">Platform digital untuk aduan awam yang efisien dan berkesan</p>
            <div class="hero-buttons">
                <?php if (!$this->getRequest()->getSession()->check('Auth')): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>" class="btn btn-lg hero-btn-gold">
                        <i class="fas fa-plus-circle me-2"></i>Daftar Aduan
                    </a>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="btn btn-lg hero-btn-light">
                        <i class="fas fa-sign-in-alt me-2"></i>Log Masuk
                    </a>
                <?php else: ?>
                    <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'index']) ?>" class="btn btn-lg hero-btn-gold">
                        <i class="fas fa-list me-2"></i>Lihat Aduan
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="gov-header">
            <h1><i class="fas fa-info-circle me-3"></i>Tentang Kami</h1>
            <p>Sistem Pengurusan Aduan Majlis Bandaraya Seberang Perai</p>
        </div>
        
        <div class="about-grid">
            <div class="card">
                <div class="card-body text-center">
                    <div class="card-icon">👁️</div>
                    <h3>Visi</h3>
                    <p>Menjadi sistem pengurusan aduan awam yang terkemuka dan dipercayai dalam menyediakan perkhidmatan yang cekap, telus, dan responsif untuk kesejahteraan komuniti.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="card-icon">🎯</div>
                    <h3>Misi</h3>
                    <p>Menyediakan platform digital yang mudah digunakan untuk memudahkan proses aduan awam, memastikan setiap aduan ditangani dengan cepat dan berkesan oleh pegawai yang bertanggungjawab.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="card-icon">📋</div>
                    <h3>Objektif</h3>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Meningkatkan kecekapan pengurusan aduan awam</li>
                        <li><i class="fas fa-check text-success me-2"></i>Memastikan ketelusan dalam proses aduan</li>
                        <li><i class="fas fa-check text-success me-2"></i>Menyediakan akses mudah untuk semua pengguna</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <div class="gov-header">
            <h1><i class="fas fa-cogs me-3"></i>Perkhidmatan Kami</h1>
            <p>Sistem Pengurusan Aduan Majlis Bandaraya Seberang Perai</p>
        </div>
        
        <div class="services-grid">
            <div class="card">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <h4>Daftar Aduan</h4>
                    <p>Daftar aduan awam dengan mudah melalui platform digital kami</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h4>Semak Status</h4>
                    <p>Semak status aduan anda secara real-time</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                    <h4>Statistik</h4>
                    <p>Lihat statistik dan laporan aduan</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="service-icon">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h4>Sokongan</h4>
                    <p>Dapatkan bantuan dan sokongan teknikal</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features-section">
    <div class="container">
        <div class="gov-header">
            <h1><i class="fas fa-star me-3"></i>Ciri-Ciri Utama</h1>
            <p>Sistem Pengurusan Aduan Majlis Bandaraya Seberang Perai</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                </div>
                <div class="feature-content">
                    <h4>Mudah Alih</h4>
                    <p>Akses sistem dari mana-mana peranti</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="feature-content">
                    <h4>Selamat</h4>
                    <p>Data dilindungi dengan enkripsi</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div class="feature-content">
                    <h4>24/7</h4>
                    <p>Sistem tersedia sepanjang masa</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div class="feature-content">
                    <h4>Analitik</h4>
                    <p>Laporan dan analisis terperinci</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-section">
    <div class="container">
        <div class="gov-header">
            <h1><i class="fas fa-phone me-3"></i>Hubungi Kami</h1>
            <p>Sistem Pengurusan Aduan Majlis Bandaraya Seberang Perai</p>
        </div>
        
        <div class="contact-grid">
            <div class="card">
                <div class="card-body">
                    <div class="contact-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h4>Alamat</h4>
                    <p>Majlis Bandaraya Seberang Perai<br>Jalan Perda Utama, Bandar Perda<br>14000 Bukit Mertajam, Pulau Pinang</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="contact-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h4>Telefon</h4>
                    <p>+604-538 2151<br>+604-538 2152</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="contact-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h4>E-mel</h4>
                    <p>aduan@mbsp.gov.my<br>support@mbsp.gov.my</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>Sedia untuk membuat aduan?</h2>
            <p>Sertai kami dalam membina komuniti yang lebih baik</p>
            <div class="cta-buttons">
                <?php if (!$this->getRequest()->getSession()->check('Auth')): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Mula Sekarang
                    </a>
                <?php else: ?>
                    <a href="<?= $this->Url->build(['controller' => 'Complaints', 'action' => 'add']) ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Buat Aduan Baru
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="gallery-section">
    <div class="container">
        <h2 class="section-title">Galeri</h2>
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/MBSP_Bandar_Perda_%28221003%29_%28cropped%29.jpg" alt="Infrastruktur" class="gallery-image">
                <div class="gallery-label">
                    <h3>Infrastruktur</h3>
                
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://www.buletinmutiara.com/wp-content/uploads/2023/11/c5a69eb2-18e8-4a70-936c-7e7a5a1c8439.jpeg" alt="Jalan Raya" class="gallery-image">
                <div class="gallery-label">
                    <h3>Jalan Raya</h3>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://www.beyondtheoutbreak.uclg.org/www.beyondtheoutbreak.uclg.org/wp-content/uploads/2020/08/Public-Service-Workers.jpg" alt="Khidmat Awam" class="gallery-image">
                <div class="gallery-label">
                    <h3>Khidmat Awam</h3>
                
                </div>
            </div>
        </div>
    </div>
</section>
