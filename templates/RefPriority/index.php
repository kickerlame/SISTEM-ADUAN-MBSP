<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RefPriority> $refPriority
 */
?>
<div class="refPriority index content">
    <?= $this->Html->link(__('Keutamaan Baru'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Keutamaan Rujukan') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('priority_id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('priority_label', 'Label Keutamaan') ?></th>
                    <th><?= $this->Paginator->sort('sla_hours', 'SLA (Jam)') ?></th>
                    <th class="actions"><?= __('Tindakan') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($refPriority as $refPriority): ?>
                <tr>
                    <td><?= $this->Number->format($refPriority->priority_id) ?></td>
                    <td><?= h($refPriority->priority_label) ?></td>
                    <td><?= $this->Number->format($refPriority->sla_hours) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Lihat'), ['action' => 'view', $refPriority->priority_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $refPriority->priority_id]) ?>
                        <?= $this->Form->postLink(
                            __('Padam'),
                            ['action' => 'delete', $refPriority->priority_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Adakah anda pasti mahu memadam keutamaan # {0}?', $refPriority->priority_id),
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