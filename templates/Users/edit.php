<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="admin-edit users-edit">
    <div class="executive-card">
        <div class="executive-card-header">
            <i class="fas fa-user-pen"></i>
            <?= __('Edit Pengguna') ?>
            <div class="ms-auto d-flex gap-2">
                <?= $this->Html->link(__('Lihat'), ['action' => 'view', $user->user_id], ['class' => 'btn btn-outline']) ?>
                <?= $this->Html->link(__('Senarai'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
                <?= $this->Form->postLink(__('Padam'), ['action' => 'delete', $user->user_id], [
                    'method' => 'delete',
                    'confirm' => __('Adakah anda pasti mahu memadam pengguna # {0}?', $user->user_id),
                    'class' => 'btn btn-gold',
                ]) ?>
            </div>
        </div>

        <div class="executive-card-body">
            <?= $this->Form->create($user) ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <?= $this->Form->control('username', [
                        'label' => __('Nama Pengguna'),
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
                    <?= $this->Form->control('ic_number', [
                        'label' => __('No. IC'),
                        'required' => true,
                        'class' => 'form-control',
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
                    <?= $this->Form->control('email', [
                        'label' => __('E-mel'),
                        'type' => 'email',
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('phone_mobile', [
                        'label' => __('No. Telefon'),
                        'class' => 'form-control',
                    ]) ?>
                </div>

                <div class="col-md-6">
                    <?= $this->Form->control('status', [
                        'label' => __('Status'),
                        'type' => 'select',
                        'options' => ['active' => __('Aktif'), 'offline' => __('Offline')],
                        'class' => 'form-select',
                    ]) ?>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <?= $this->Form->button(__('Simpan Perubahan'), ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Batal'), ['action' => 'view', $user->user_id], ['class' => 'btn btn-outline']) ?>
            </div>

            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
