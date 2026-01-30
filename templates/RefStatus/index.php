<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RefStatus> $refStatus
 */
?>
<div class="refStatus index content">
    <?= $this->Html->link(__('Status Baru'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Status Rujukan') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('status_id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('status_name', 'Nama Status') ?></th>
                    <th><?= $this->Paginator->sort('status_color', 'Warna Status') ?></th>
                    <th class="actions"><?= __('Tindakan') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($refStatus as $refStatus): ?>
                <tr>
                    <td><?= $this->Number->format($refStatus->status_id) ?></td>
                    <td><?= h($refStatus->status_name) ?></td>
                    <td><?= h($refStatus->status_color) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Lihat'), ['action' => 'view', $refStatus->status_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $refStatus->status_id]) ?>
                        <?= $this->Form->postLink(
                            __('Padam'),
                            ['action' => 'delete', $refStatus->status_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Adakah anda pasti mahu memadam status # {0}?', $refStatus->status_id),
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