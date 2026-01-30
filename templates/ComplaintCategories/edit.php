<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintCategory $complaintCategory
 * @var string[]|\Cake\Collection\CollectionInterface $departments
 */
?>
<div class="admin-edit complaint-categories-edit">
    <div class="executive-card">
        <div class="executive-card-header">
            <i class="fas fa-tag"></i>
            <?= __('Edit Kategori') ?>
            <div class="ms-auto d-flex gap-2">
                <?= $this->Html->link(__('Senarai'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
            </div>
        </div>

        <div class="executive-card-body">
            <?= $this->Form->create($complaintCategory) ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <?= $this->Form->control('department_id', [
                        'options' => $departments,
                        'label' => __('Jabatan'),
                        'empty' => __('-- Pilih Jabatan --'),
                        'class' => 'form-select',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('category_name', [
                        'label' => __('Nama Kategori'),
                        'class' => 'form-control',
                        'required' => true,
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
