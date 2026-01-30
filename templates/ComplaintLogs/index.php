<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ComplaintLog> $complaintLogs
 */
?>
<div class="complaintLogs index content">
    <?= $this->Html->link(__('Log Baru'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Log Aduan') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('log_id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('complaint_id', 'Aduan') ?></th>
                    <th><?= $this->Paginator->sort('user_id', 'Pengguna') ?></th>
                    <th><?= $this->Paginator->sort('action_taken', 'Tindakan Diambil') ?></th>
                    <th><?= $this->Paginator->sort('status_after', 'Status Selepas') ?></th>
                    <th><?= $this->Paginator->sort('created_at', 'Tarikh Dibuat') ?></th>
                    <th class="actions"><?= __('Tindakan') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($complaintLogs as $complaintLog): ?>
                <tr>
                    <td><?= $this->Number->format($complaintLog->log_id) ?></td>
                    <td><?= $complaintLog->hasValue('complaint') ? $this->Html->link($complaintLog->complaint->complaint_no, ['controller' => 'Complaints', 'action' => 'view', $complaintLog->complaint->complaint_id]) : '' ?></td>
                    <td><?= $complaintLog->hasValue('user') ? $this->Html->link($complaintLog->user->username, ['controller' => 'Users', 'action' => 'view', $complaintLog->user->user_id]) : '' ?></td>
                    <td><?= h($complaintLog->action_taken) ?></td>
                    <td><?= $complaintLog->status_after === null ? '' : $this->Number->format($complaintLog->status_after) ?></td>
                    <td><?= h($complaintLog->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Lihat'), ['action' => 'view', $complaintLog->log_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $complaintLog->log_id]) ?>
                        <?= $this->Form->postLink(
                            __('Padam'),
                            ['action' => 'delete', $complaintLog->log_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Adakah anda pasti mahu memadam log # {0}?', $complaintLog->log_id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('pertama')) ?>
            <?= $this->Paginator->prev('< ' . __('sebelum')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('seterusnya') . ' >') ?>
            <?= $this->Paginator->last(__('terakhir') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Muka surat {{page}} daripada {{pages}}, menunjukkan {{current}} rekod daripada {{count}} jumlah')) ?></p>
    </div>
</div>