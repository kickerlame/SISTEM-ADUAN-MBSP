<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Officer $officer
 */
?>
<div class="admin-view officers-view">
    <div class="executive-card">
        <div class="executive-card-header">
            <i class="fas fa-user-shield"></i>
            <?= __('Profil Pegawai') ?>
            <div class="ms-auto d-flex gap-2">
                <?= $this->Html->link(__('Kemaskini'), ['action' => 'edit', $officer->officer_id], ['class' => 'btn btn-outline']) ?>
                <?= $this->Html->link(__('Senarai'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
            </div>
        </div>

        <div class="executive-card-body">
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-id-badge me-2"></i><?= __('Maklumat Pegawai') ?></h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th width="30%"><?= __('Nama Penuh') ?></th>
                                    <td><?= h($officer->full_name ?? 'Tidak Diketahui') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('ID Staf') ?></th>
                                    <td><span class="badge bg-primary"><?= h($officer->staff_id ?? 'N/A') ?></span></td>
                                </tr>
                                <tr>
                                    <th><?= __('Jabatan') ?></th>
                                    <td><?= $officer->hasValue('department') ? h($officer->department->department_name) : __('N/A') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('No. Telefon') ?></th>
                                    <td><?= h($officer->phone_no ?? 'N/A') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Jawatan') ?></th>
                                    <td><?= h(($officer->role ?? '') === 'admin' ? 'Pentadbir' : 'Pegawai') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Status') ?></th>
                                    <td><?= h(($officer->status ?? '') === 'active' ? 'Aktif' : 'Offline') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('ID Pegawai') ?></th>
                                    <td><?= $this->Number->format($officer->officer_id) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="user-avatar mx-auto mb-3">
                                <?= strtoupper(substr((string)($officer->full_name ?? 'P'), 0, 1)) ?>
                            </div>
                            <h5 class="text-primary mb-2"><?= h($officer->full_name ?? 'Pegawai') ?></h5>
                            <span class="badge bg-primary"><?= h(($officer->role ?? '') === 'admin' ? 'Pentadbir' : 'Pegawai') ?></span>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-circle-info me-2"></i><?= __('Nota') ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info mb-0">
                                <strong><?= __('Maklumat') ?>:</strong>
                                <div class="text-muted"><?= __('Pegawai ini mempunyai akses ke modul aduan mengikut peranan yang ditetapkan.') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>