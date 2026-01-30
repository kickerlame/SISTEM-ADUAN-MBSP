<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RefPriority $refPriority
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Tindakan') ?></h4>
            <?= $this->Html->link(__('Edit Keutamaan'), ['action' => 'edit', $refPriority->priority_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Padam Keutamaan'), ['action' => 'delete', $refPriority->priority_id], ['confirm' => __('Adakah anda pasti mahu memadam keutamaan # {0}?', $refPriority->priority_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Senarai Keutamaan'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Keutamaan Baru'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="refPriority view content">
            <h3><?= h($refPriority->priority_label) ?></h3>
            <table>
                <tr>
                    <th><?= __('Label Keutamaan') ?></th>
                    <td><?= h($refPriority->priority_label) ?></td>
                </tr>
                <tr>
                    <th><?= __('ID Keutamaan') ?></th>
                    <td><?= $this->Number->format($refPriority->priority_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('SLA (Jam)') ?></th>
                    <td><?= $this->Number->format($refPriority->sla_hours) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>