<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintCategory $complaintCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Tindakan') ?></h4>
            <?= $this->Html->link(__('Edit Kategori'), ['action' => 'edit', $complaintCategory->category_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Padam Kategori'), ['action' => 'delete', $complaintCategory->category_id], ['confirm' => __('Adakah anda pasti mahu memadam kategori # {0}?', $complaintCategory->category_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Senarai Kategori'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Kategori Baru'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintCategories view content">
            <h3><?= h($complaintCategory->category_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Jabatan') ?></th>
                    <td><?= $complaintCategory->hasValue('department') ? $this->Html->link($complaintCategory->department->department_name, ['controller' => 'Departments', 'action' => 'view', $complaintCategory->department->department_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nama Kategori') ?></th>
                    <td><?= h($complaintCategory->category_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('ID Kategori') ?></th>
                    <td><?= $this->Number->format($complaintCategory->category_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>