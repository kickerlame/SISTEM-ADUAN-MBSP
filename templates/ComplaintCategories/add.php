<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintCategory $complaintCategory
 * @var \Cake\Collection\CollectionInterface|string[] $departments
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Tindakan') ?></h4>
            <?= $this->Html->link(__('Senarai Kategori'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintCategories form content">
            <?= $this->Form->create($complaintCategory) ?>
            <fieldset>
                <legend><?= __('Tambah Kategori Baru') ?></legend>
                <?php
                    echo $this->Form->control('department_id', ['options' => $departments, 'label' => 'Jabatan']);
                    echo $this->Form->control('category_name', ['label' => 'Nama Kategori']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Hantar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
