<div class="content-area">
    <div class="gov-header">
        <h1><i class="fas fa-key me-3"></i>Lupa Kata Laluan</h1>
        <p>Sistem Pengurusan Aduan Majlis Bandaraya Seberang Perai</p>
        <div class="gov-badge">Sistem Kerajaan</div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->Url->build(['action' => 'login']) ?>">Log Masuk</a></li>
            <li class="breadcrumb-item active">Lupa Kata Laluan</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Tetapkan Semula Kata Laluan</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong><?= __('Maklumat Penting') ?>:</strong>
                <?= __('Masukkan alamat e-mel anda untuk menetapkan semula kata laluan.') ?>
            </div>

            <?= $this->Flash->render() ?>

            <?= $this->Form->create(null, ['class' => 'needs-validation', 'novalidate' => true]) ?>
                <div class="mb-4">
                    <?= $this->Form->control('email', [
                        'label' => 'Alamat E-mel',
                        'class' => 'form-control',
                        'required' => true,
                        'placeholder' => 'Masukkan alamat e-mel anda',
                        'type' => 'email'
                    ]) ?>
                </div>

                <div class="d-grid gap-2">
                    <?= $this->Form->button('Hantar', [
                        'type' => 'submit',
                        'class' => 'btn btn-primary btn-lg'
                    ]) ?>
                </div>

            <?= $this->Form->end() ?>

            <div class="text-center mt-4">
                <p class="mb-0">
                    <?= $this->Html->link('<i class="fas fa-arrow-left me-2"></i>Kembali ke Log Masuk', ['action' => 'login'], ['class' => 'btn btn-outline-primary', 'escape' => false]) ?>
                </p>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>Bantuan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary"><i class="fas fa-check-circle me-2"></i>Langkah 1</h6>
                    <p>Masukkan alamat e-mel yang didaftarkan dengan akaun anda.</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary"><i class="fas fa-check-circle me-2"></i>Langkah 2</h6>
                    <p>Semak e-mel anda untuk pautan tetapkan semula kata laluan.</p>
                </div>
            </div>
            <div class="alert alert-warning mt-3">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Perhatian:</strong> Pautan tetapkan semula akan tamat tempoh dalam 24 jam.
            </div>
        </div>
    </div>
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
