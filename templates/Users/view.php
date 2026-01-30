<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="admin-view users-view">
    <div class="executive-card">
        <div class="executive-card-header">
            <i class="fas fa-user"></i>
            <?= __('Profil Pengguna') ?>
            <div class="ms-auto d-flex gap-2">
                <?= $this->Html->link(__('Kemaskini'), ['action' => 'edit', $user->user_id], ['class' => 'btn btn-outline']) ?>
                <?= $this->Html->link(__('Senarai'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
                <?php if (!empty($isAdmin)): ?>
                    <?= $this->Form->postLink(__('Padam'), ['action' => 'delete', $user->user_id], [
                        'method' => 'delete',
                        'confirm' => __('Adakah anda pasti mahu memadam pengguna # {0}?', $user->user_id),
                        'class' => 'btn btn-gold',
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="executive-card-body">
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-id-card me-2"></i><?= __('Maklumat Pengguna') ?></h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th width="30%"><?= __('Nama Pengguna') ?></th>
                                    <td><span class="badge bg-primary"><?= h($user->username) ?></span></td>
                                </tr>
                                <tr>
                                    <th><?= __('Nama Penuh') ?></th>
                                    <td><?= h($user->full_name ?? 'Tidak Diketahui') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('No. IC') ?></th>
                                    <td><?= h($user->ic_number ?? 'Tidak Diketahui') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('E-mel') ?></th>
                                    <td><?= h($user->email ?? 'Tidak Diketahui') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Nombor Telefon') ?></th>
                                    <td><?= h($user->phone_mobile ?? 'Tidak Diketahui') ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('ID Pengguna') ?></th>
                                    <td><?= $this->Number->format($user->user_id) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="user-avatar mx-auto mb-3">
                                <?= strtoupper(substr($user->username, 0, 1)) ?>
                            </div>
                            <h5 class="text-primary mb-2"><?= h($user->username) ?></h5>
                            <span class="badge bg-primary"><?= h(!empty($isAdmin) ? 'Pentadbir' : 'Pengguna') ?></span>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="fas fa-circle-info me-2"></i><?= __('Maklumat Lanjut') ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info mb-0">
                                <strong><?= __('Maklumat') ?>:</strong>
                                <div class="text-muted"><?= __('Profil ini adalah rekod pengguna dalam sistem MBSP.') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
