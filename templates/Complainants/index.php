<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Complainant> $complainants
 */
?>
<?php
$authUser = $this->getRequest()->getSession()->read('Auth');
?>
<div class="complainants index content">
    <?php if ($authUser && $authUser->role === 'admin'): ?>
        <?php // Admin can only view list, no add button ?>
    <?php endif; ?>
    <h3><?= __('Senarai Pengadu') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('complainant_id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('full_name', 'Nama Penuh') ?></th>
                    <th><?= $this->Paginator->sort('ic_number', 'No. IC') ?></th>
                    <th><?= $this->Paginator->sort('phone_mobile', 'No. Telefon') ?></th>
                    <th><?= $this->Paginator->sort('email', 'E-mel') ?></th>
                    <th><?= $this->Paginator->sort('created_at', 'Tarikh Didaftar') ?></th>
                    <th class="actions"><?= __('Tindakan') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($complainants as $complainant): ?>
                <tr>
                    <td><?= $this->Number->format($complainant->complainant_id) ?></td>
                    <td><?= h($complainant->full_name) ?></td>
                    <td><?= h($complainant->ic_number) ?></td>
                    <td><?= h($complainant->phone_mobile ?? 'N/A') ?></td>
                    <td><?= h($complainant->email ?? 'N/A') ?></td>
                    <td><?= $complainant->created_at ? h($complainant->created_at->format('d/m/Y')) : 'N/A' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Lihat'), ['action' => 'view', $complainant->complainant_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $complainant->complainant_id]) ?>
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
