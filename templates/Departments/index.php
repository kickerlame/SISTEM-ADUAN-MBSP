<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Department> $departments
 */
?>
<div class="admin-index departments-index">
    <div class="executive-card">
        <div class="executive-card-header">
            <i class="fas fa-building"></i>
            <?= __('Senarai Jabatan') ?>
            <div class="ms-auto">
                <?= $this->Html->link(__('Jabatan Baru'), ['action' => 'add'], ['class' => 'btn btn-gold']) ?>
            </div>
        </div>

        <div class="executive-card-body">
            <?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'index']]) ?>
            <div class="row g-2 align-items-center mb-3">
                <div class="col-md-9">
                    <?= $this->Form->control('search', [
                        'label' => false,
                        'placeholder' => __('Cari mengikut Nama Jabatan...'),
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
                    <th><?= $this->Paginator->sort('department_id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('department_name', 'Nama Jabatan') ?></th>
                    <th class="actions"><?= __('Tindakan') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($departments->toArray())): ?>
                <tr>
                    <td colspan="3" style="text-align: center; padding: 2rem; color: var(--gov-text-muted);">
                        <?= __('Tiada rekod dijumpai.') ?>
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($departments as $department): ?>
                    <tr>
                        <td><?= $this->Number->format($department->department_id) ?></td>
                        <td><?= h($department->department_name) ?></td>
                        <td class="actions">
                            <div class="btn-group" role="group">
                                <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $department->department_id], ['class' => 'btn-glass btn-sm', 'escape' => false, 'title' => 'Edit']) ?>
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
