<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php
$authUser = $this->getRequest()->getSession()->read('Auth');
$isAdmin = $authUser && $authUser->role === 'admin';
?>
<div class="content-area">
    <div class="gov-header">
        <h1><i class="fas fa-user-plus me-3"></i><?= $isAdmin ? 'Tambah Pengguna Awam Baru' : 'Daftar Akaun Pengguna Awam' ?></h1>
        <p>Sistem Pengurusan Aduan Majlis Bandaraya Seberang Perai</p>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->Url->build(['action' => 'index']) ?>">Senarai Pengguna</a></li>
            <li class="breadcrumb-item active"><?= $isAdmin ? 'Tambah Pengguna' : 'Daftar' ?></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Maklumat Pengguna</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong><?= __('Maklumat Penting') ?>:</strong>
                <?= $isAdmin ? __('Tambah pengguna awam baru ke dalam sistem.') : __('Sila isi maklumat di bawah untuk mendaftar sebagai pengguna awam.') ?>
            </div>

            <?= $this->Form->create($user, ['class' => 'needs-validation', 'novalidate' => true]) ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= $this->Form->control('username', [
                                'label' => 'Nama Pengguna (untuk log masuk)',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'Masukkan nama pengguna'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= $this->Form->control('password', [
                                'label' => 'Kata Laluan',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'Masukkan kata laluan',
                                'type' => 'password'
                            ]) ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= $this->Form->control('ic_number', [
                                'label' => 'No. IC',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'Masukkan No. IC',
                                'maxlength' => 20
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= $this->Form->control('full_name', [
                                'label' => 'Nama Penuh',
                                'class' => 'form-control',
                                'required' => true,
                                'placeholder' => 'Masukkan nama penuh'
                            ]) ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= $this->Form->control('email', [
                                'label' => 'E-mel (pilihan)',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan alamat e-mel',
                                'type' => 'email'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <?= $this->Form->control('phone_mobile', [
                                'label' => 'No. Telefon (pilihan)',
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan no. telefon'
                            ]) ?>
                        </div>
                    </div>
                </div>

                <?php if ($isAdmin): ?>
                    <div class="mb-3">
                        <?= $this->Form->control('status', [
                            'label' => 'Status',
                            'class' => 'form-select',
                            'type' => 'select',
                            'options' => ['active' => 'Aktif', 'offline' => 'Offline'],
                            'default' => 'active'
                        ]) ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Ruangan bertanda * adalah wajib diisi
                        </small>
                    </div>
                    <div class="btn-group">
                        <?= $this->Html->link('Batal', $isAdmin ? ['action' => 'index'] : ['action' => 'login'], ['class' => 'btn btn-outline']) ?>
                        <?= $this->Form->button($isAdmin ? 'Tambah Pengguna' : 'Daftar', [
                            'type' => 'submit',
                            'class' => 'btn btn-primary'
                        ]) ?>
                    </div>
                </div>

            <?= $this->Form->end() ?>
        </div>
    </div>

    <?php if (!$isAdmin): ?>
        <div class="card mt-4">
            <div class="card-body text-center">
                <p class="mb-0">
                    <?= __('Sudah ada akaun?') ?>
                    <?= $this->Html->link(__('Log Masuk'), ['action' => 'login'], ['class' => 'btn btn-outline-primary ms-2']) ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
