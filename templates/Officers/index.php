<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Officer> $officers
 */
?>
<div class="admin-index officers-index">
    <div class="executive-card">
        <div class="executive-card-header">
            <i class="fas fa-user-shield"></i>
            <?= __('Senarai Pegawai') ?>
            <div class="ms-auto">
                <?= $this->Html->link(__('Pegawai Baru'), ['action' => 'add'], ['class' => 'btn btn-gold']) ?>
            </div>
        </div>

        <div class="executive-card-body">
            <?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'index']]) ?>
            <div class="row g-2 align-items-center mb-3">
                <div class="col-md-9">
                    <?= $this->Form->control('search', [
                        'label' => false,
                        'placeholder' => __('Cari mengikut Nama, ID Staf, atau Jabatan...'),
                        'value' => $search ?? '',
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="col-md-3 d-grid">
                    <?= $this->Form->button(__('Cari'), ['class' => 'btn btn-primary']) ?>
                </div>
                <?php if (!empty($search)): ?>
                <div class="col-12 text-end">
                    <?= $this->Html->link(__('Batal'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
                </div>
                <?php endif; ?>
            </div>
            <?= $this->Form->end() ?>

            <div class="table-responsive">
                <table class="executive-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('officer_id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('department_id', 'Jabatan') ?></th>
                    <th><?= $this->Paginator->sort('full_name', 'Nama Penuh') ?></th>
                    <th><?= $this->Paginator->sort('staff_id', 'ID Staf') ?></th>
                    <th><?= $this->Paginator->sort('phone_no', 'No. Telefon') ?></th>
                    <th><?= $this->Paginator->sort('role', 'Jawatan') ?></th>
                    <th><?= $this->Paginator->sort('status', 'Status') ?></th>
                    <th class="actions"><?= __('Tindakan') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($officers->toArray())): ?>
                <tr>
                    <td colspan="8" style="text-align: center; padding: 2rem; color: var(--gov-text-muted);">
                        <?= __('Tiada rekod dijumpai.') ?>
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($officers as $officer): ?>
                    <tr>
                        <td><?= $this->Number->format($officer->officer_id) ?></td>
                        <td><?= $officer->hasValue('department') ? h($officer->department->department_name) : __('N/A') ?></td>
                        <td><?= h($officer->full_name) ?></td>
                        <td><?= h($officer->staff_id) ?></td>
                        <td><?= h($officer->phone_no ?? 'N/A') ?></td>
                        <td><?= h($officer->role === 'admin' ? 'Pentadbir' : 'Pegawai') ?></td>
                        <td><?= h($officer->status === 'active' ? 'Aktif' : 'Offline') ?></td>
                        <td class="actions">
                            <div class="btn-group" role="group">
                                <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $officer->officer_id], ['class' => 'btn-glass btn-sm', 'escape' => false, 'title' => 'Lihat']) ?>
                                <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $officer->officer_id], ['class' => 'btn-glass btn-sm', 'escape' => false, 'title' => 'Edit']) ?>
                                <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $officer->officer_id], [
                                    'method' => 'delete',
                                    'confirm' => __('Adakah anda pasti mahu memadam pegawai # {0}?', $officer->officer_id),
                                    'class' => 'btn-glass btn-sm',
                                    'escape' => false,
                                    'title' => 'Padam'
                                ]) ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    <?= $this->Paginator->counter(__('Muka surat {{page}} daripada {{pages}}, menunjukkan {{current}} rekod daripada {{count}} jumlah')) ?>
                </div>
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('sebelum')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('seterusnya') . ' >') ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
