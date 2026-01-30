<div class="login-container">
    <div class="login-branding">
        <div class="branding-content">
            <div class="branding-logo">
                <i class="fas fa-landmark"></i>
            </div>
            <h1>SISTEM ADUAN MBSP</h1>
            <p>Sistem Pengurusan Aduan Executive</p>
            <div class="branding-badge">Portal Kerajaan Premium</div>
        </div>
    </div>
    
    <div class="login-form-wrapper">
        <div class="login-form">
            <?= $this->Flash->render() ?>
            
            <div class="login-logo">
                <i class="fas fa-shield-alt"></i>
                <h2>Selamat Datang</h2>
                <p>Sila masuk ke sistem executive</p>
            </div>
            
            <?= $this->Form->create() ?>
            <div class="form-group">
                <?= $this->Form->control('username', [
                    'label' => __('Nama Pengguna'),
                    'required' => true,
                    'placeholder' => __('Masukkan nama pengguna'),
                    'class' => 'form-control form-control-executive'
                ]) ?>
            </div>
            
            <div class="form-group">
                <?= $this->Form->control('password', [
                    'label' => __('Kata Laluan'),
                    'required' => true,
                    'placeholder' => __('Masukkan kata laluan'),
                    'class' => 'form-control form-control-executive'
                ]) ?>
            </div>
            
            <div class="form-actions">
                <?= $this->Form->button(__('Log Masuk'), ['class' => 'btn-executive w-100']) ?>
            </div>
            
            <div class="form-footer">
                <div class="text-center">
                    <?= $this->Html->link(__('Lupa kata laluan?'), ['action' => 'forgotPassword'], ['class' => 'link-primary']) ?>
                </div>
                <div class="text-center mt-3">
                    <span class="text-muted">Belum mempunyai akaun?</span><br>
                    <?= $this->Html->link(__('Daftar di sini'), ['action' => 'add'], ['class' => 'link-primary']) ?>
                </div>
            </div>
            
            <?= $this->Form->end() ?>
            
            <div class="security-notice">
                <div class="notice-content">
                    <div class="notice-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="notice-text">
                        <strong>Selamat & Terjamin</strong>
                        <p>Data anda dilindungi dengan enkripsi tahap tinggi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
