<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Officer $officer
 * @var string[]|\Cake\Collection\CollectionInterface $departments
 */
?>
<div class="admin-edit officers-edit">
    <div class="executive-card">
        <div class="executive-card-header">
            <i class="fas fa-user-pen"></i>
            <?= __('Sunting Pegawai') ?>
            <div class="ms-auto d-flex gap-2">
                <?= $this->Html->link(__('Lihat'), ['action' => 'view', $officer->officer_id], ['class' => 'btn btn-outline']) ?>
                <?= $this->Html->link(__('Senarai'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
            </div>
        </div>

        <div class="executive-card-body">
            <div class="alert alert-info mb-3">
                <i class="fas fa-id-badge me-2"></i>
                <strong><?= __('ID Staf') ?>:</strong> <?= h($officer->staff_id) ?> <span class="text-muted">(<?= __('tidak boleh diubah') ?>)</span>
            </div>

            <?= $this->Form->create($officer) ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <?= $this->Form->control('username', [
                        'label' => __('Nama Pengguna (untuk log masuk)'),
                        'required' => true,
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('password', [
                        'label' => __('Kata Laluan'),
                        'type' => 'password',
                        'value' => '',
                        'required' => false,
                        'placeholder' => __('Biarkan kosong jika tiada perubahan'),
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('role', [
                        'label' => __('Jawatan'),
                        'options' => ['admin' => __('Pentadbir'), 'officer' => __('Pegawai')],
                        'required' => true,
                        'class' => 'form-select',
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('status', [
                        'label' => __('Status'),
                        'type' => 'select',
                        'options' => ['active' => __('Aktif'), 'offline' => __('Offline')],
                        'required' => true,
                        'class' => 'form-select',
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('full_name', [
                        'label' => __('Nama Penuh'),
                        'required' => true,
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('department_id', [
                        'options' => $departments,
                        'label' => __('Jabatan'),
                        'required' => true,
                        'empty' => __('-- Pilih Jabatan --'),
                        'class' => 'form-select',
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('phone_no', [
                        'label' => __('No. Telefon (pilihan)'),
                        'class' => 'form-control',
                    ]) ?>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <?= $this->Form->button(__('Simpan Perubahan'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Batal'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
            </div>

            <?= $this->Form->end() ?>
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