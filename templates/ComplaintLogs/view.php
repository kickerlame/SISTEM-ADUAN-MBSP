<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintLog $complaintLog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Tindakan') ?></h4>
            <?= $this->Html->link(__('Edit Log'), ['action' => 'edit', $complaintLog->log_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Padam Log'), ['action' => 'delete', $complaintLog->log_id], ['confirm' => __('Adakah anda pasti mahu memadam log # {0}?', $complaintLog->log_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Senarai Log'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Log Baru'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintLogs view content">
            <h3><?= h($complaintLog->action_taken) ?></h3>
            <table>
                <tr>
                    <th><?= __('Aduan') ?></th>
                    <td><?= $complaintLog->hasValue('complaint') ? $this->Html->link($complaintLog->complaint->complaint_no, ['controller' => 'Complaints', 'action' => 'view', $complaintLog->complaint->complaint_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Pengguna') ?></th>
                    <td><?= $complaintLog->hasValue('user') ? $this->Html->link($complaintLog->user->username, ['controller' => 'Users', 'action' => 'view', $complaintLog->user->user_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tindakan Diambil') ?></th>
                    <td><?= h($complaintLog->action_taken) ?></td>
                </tr>
                <tr>
                    <th><?= __('ID Log') ?></th>
                    <td><?= $this->Number->format($complaintLog->log_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status Selepas') ?></th>
                    <td><?= $complaintLog->status_after === null ? '' : $this->Number->format($complaintLog->status_after) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tarikh Dibuat') ?></th>
                    <td><?= h($complaintLog->created_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Catatan') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($complaintLog->notes)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>