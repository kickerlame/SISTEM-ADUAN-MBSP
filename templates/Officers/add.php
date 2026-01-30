<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Officer $officer
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 */
?>
<div class="admin-add officers-add">
    <div class="executive-card">
        <div class="executive-card-header">
            <i class="fas fa-user-plus"></i>
            <?= __('Tambah Pegawai Baru') ?>
            <div class="ms-auto d-flex gap-2">
                <?= $this->Html->link(__('Senarai'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
            </div>
        </div>

        <div class="executive-card-body">
            <div class="alert alert-info mb-3">
                <i class="fas fa-info-circle me-2"></i>
                <strong><?= __('Jawatan') ?>:</strong> <?= __('Pegawai') ?> <span class="text-muted">(<?= __('ditentukan secara automatik') ?>)</span><br>
                <strong><?= __('ID Staf') ?>:</strong> <?= __('Akan dijana secara automatik') ?>
            </div>

            <?= $this->Form->create($officer) ?>
            <?= $this->Form->hidden('role', ['value' => 'officer']) ?>
            <?= $this->Form->hidden('staff_id', ['value' => '']) ?>

            <div class="row g-3">
                <div class="col-md-6">
                    <?= $this->Form->control('username', [
                        'label' => __('Nama Pengguna (untuk log masuk)'),
                        'required' => true,
                        'class' => 'form-control',
                        'placeholder' => __('Masukkan nama pengguna'),
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('password', [
                        'label' => __('Kata Laluan'),
                        'required' => true,
                        'type' => 'password',
                        'class' => 'form-control',
                        'placeholder' => __('Masukkan kata laluan'),
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('full_name', [
                        'label' => __('Nama Penuh'),
                        'required' => true,
                        'class' => 'form-control',
                        'placeholder' => __('Masukkan nama penuh'),
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
                        'placeholder' => __('Masukkan no. telefon'),
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('status', [
                        'label' => __('Status'),
                        'type' => 'select',
                        'options' => ['active' => __('Aktif'), 'offline' => __('Offline')],
                        'default' => 'active',
                        'required' => true,
                        'class' => 'form-select',
                    ]) ?>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <?= $this->Form->button(__('Tambah Pegawai'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Batal'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
