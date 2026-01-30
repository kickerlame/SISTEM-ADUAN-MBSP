<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->department_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->department_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Departments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Department'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="departments view content">
            <h3><?= h($department->department_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Department Name') ?></th>
                    <td><?= h($department->department_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Department Id') ?></th>
                    <td><?= $this->Number->format($department->department_id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($department->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>