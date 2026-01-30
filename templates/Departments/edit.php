<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="admin-edit departments-edit">
    <div class="executive-card">
        <div class="executive-card-header">
            <i class="fas fa-building"></i>
            <?= __('Edit Jabatan') ?>
            <div class="ms-auto d-flex gap-2">
                <?= $this->Html->link(__('Senarai'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
            </div>
        </div>

        <div class="executive-card-body">
            <?= $this->Form->create($department) ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <?= $this->Form->control('department_name', [
                        'label' => __('Nama Jabatan'),
                        'class' => 'form-control',
                        'required' => true,
                    ]) ?>
                </div>
                <div class="col-12">
                    <?= $this->Form->control('description', [
                        'label' => __('Keterangan'),
                        'type' => 'textarea',
                        'class' => 'form-control',
                        'rows' => 4,
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
