<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Officer $officer
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 */
?>
<div class="profile-page admin-profile">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="executive-card">
                <div class="executive-card-header">
                    <i class="fas fa-bolt"></i>
                    <?= __('Tindakan') ?>
                </div>
                <div class="executive-card-body">
                    <?= $this->Html->link(__('Kembali ke Dashboard'), ['controller' => 'Complaints', 'action' => 'index'], ['class' => 'btn btn-outline w-100']) ?>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="executive-card">
                <div class="executive-card-header">
                    <i class="fas fa-user-shield"></i>
                    <?= __('Profil Pentadbir') ?>
                </div>
                <div class="executive-card-body">
                    <p class="text-muted mb-4"><?= __('Kemaskini maklumat profil pentadbir anda di sini.') ?></p>

                    <?= $this->Form->create($officer, ['class' => 'profile-form']) ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= $this->Form->control('username', [
                                'label' => ['text' => 'Nama Pengguna', 'class' => 'form-label'],
                                'readonly' => true,
                                'disabled' => true,
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('password', [
                                'label' => ['text' => 'Kata Laluan', 'class' => 'form-label'],
                                'value' => '',
                                'required' => false,
                                'placeholder' => 'Biarkan kosong jika tiada perubahan',
                                'class' => 'form-control'
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <div class="form-label">Jawatan</div>
                            <div class="text-muted">Pentadbir (tidak boleh diubah)</div>
                            <?= $this->Form->hidden('role', ['value' => 'admin']) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('full_name', [
                                'label' => ['text' => 'Nama Penuh', 'class' => 'form-label'],
                                'required' => true,
                                'class' => 'form-control'
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <div class="form-label">ID Staf</div>
                            <div class="text-muted mb-2"><?= h($officer->staff_id) ?> (tidak boleh diubah)</div>
                            <?= $this->Form->hidden('staff_id', ['value' => $officer->staff_id]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('department_id', [
                                'options' => $departments,
                                'label' => ['text' => 'Jabatan', 'class' => 'form-label'],
                                'required' => true,
                                'empty' => '-- Pilih Jabatan --',
                                'class' => 'form-select'
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('phone_no', [
                                'label' => ['text' => 'No. Telefon', 'class' => 'form-label'],
                                'class' => 'form-control'
                            ]) ?>
                        </div>

                        <div class="col-md-6">
                            <?= $this->Form->control('status', [
                                'label' => ['text' => 'Status', 'class' => 'form-label'],
                                'type' => 'select',
                                'options' => ['active' => 'Aktif', 'offline' => 'Offline'],
                                'required' => true,
                                'class' => 'form-select'
                            ]) ?>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <?= $this->Form->button(__('Kemaskini Profil'), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Html->link(__('Batal'), ['controller' => 'Complaints', 'action' => 'index'], ['class' => 'btn btn-outline']) ?>
                    </div>

                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Re-enable disabled fields for form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            const disabledFields = form.querySelectorAll('[disabled]');
            disabledFields.forEach(function(field) {
                field.disabled = false;
            });
        });
    }
});
</script>
