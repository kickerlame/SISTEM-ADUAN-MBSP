<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Complaint $complaint
 */
?>

    <div class="gov-header">
        <h1><i class="fas fa-eye me-3"></i>Butiran Aduan #<?= h($complaint->complaint_no) ?></h1>
        <p>Sistem Pengurusan Aduan Majlis Bandaraya Seberang Perai</p>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $this->Url->build(['action' => 'index']) ?>">Aduan</a></li>
            <li class="breadcrumb-item active">Butiran Aduan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Maklumat Aduan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">No. Aduan</th>
                            <td><span class="badge bg-primary"><?= h($complaint->complaint_no) ?></span></td>
                        </tr>
                        <tr>
                            <th>Tajuk Aduan</th>
                            <td><?= h($complaint->complaint_title ?? 'Tidak Diketahui') ?></td>
                        </tr>
                        <tr>
                            <th>Pengadu</th>
                            <td>
                                <?php if ($complaint->hasValue('complainant')): ?>
                                    <?= $this->Html->link($complaint->complainant->full_name, ['controller' => 'Complainants', 'action' => 'view', $complaint->complainant->complainant_id]) ?>
                                <?php else: ?>
                                    <span class="text-muted">Tidak Diketahui</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>
                                <?php if ($complaint->hasValue('category')): ?>
                                    <?= $this->Html->link($complaint->category->category_name, ['controller' => 'ComplaintCategories', 'action' => 'view', $complaint->category->category_id]) ?>
                                <?php else: ?>
                                    <span class="text-muted">Tidak Diketahui</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if ($complaint->hasValue('status')): ?>
                                    <?php
                                    $statusName = h($complaint->status->status_name);
                                    $badgeClass = 'bg-secondary';
                                    if (stripos($statusName, 'Baru') !== false) {
                                        $badgeClass = 'bg-warning';
                                    } elseif (stripos($statusName, 'Selesai') !== false) {
                                        $badgeClass = 'bg-success';
                                    } elseif (stripos($statusName, 'Tinggi') !== false) {
                                        $badgeClass = 'bg-danger';
                                    }
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $statusName ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Keutamaan</th>
                            <td>
                                <?php 
                                $priorityLabel = $complaint->hasValue('priority') ? $complaint->priority->priority_label : '';
                                $badgeClass = 'bg-secondary';
                                if (stripos($priorityLabel, 'Tinggi') !== false) {
                                    $badgeClass = 'bg-danger';
                                } elseif (stripos($priorityLabel, 'Sederhana') !== false) {
                                    $badgeClass = 'bg-warning';
                                } elseif (stripos($priorityLabel, 'Biasa') !== false) {
                                    $badgeClass = 'bg-success';
                                }
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= h($priorityLabel) ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Pegawai Bertanggungjawab</th>
                            <td>
                                <?php if ($complaint->hasValue('officer')): ?>
                                    <?= $this->Html->link($complaint->officer->full_name, ['controller' => 'Officers', 'action' => 'view', $complaint->officer->officer_id]) ?>
                                <?php else: ?>
                                    <span class="text-muted">Belum Ditugaskan</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Daerah</th>
                            <td><span class="badge bg-info"><?= h($complaint->district) ?></span></td>
                        </tr>
                        <tr>
                            <th>Tarikh Akhir</th>
                            <td><?= $complaint->deadline_at ? h($complaint->deadline_at->format('d/m/Y H:i')) : 'Tidak Diketahui' ?></td>
                        </tr>
                        <tr>
                            <th>Tarikh Dibuat</th>
                            <td><?= $complaint->created_at ? h($complaint->created_at->format('d/m/Y H:i')) : 'Tidak Diketahui' ?></td>
                        </tr>
                        <tr>
                            <th>Tarikh Kemaskini</th>
                            <td><?= $complaint->updated_at ? h($complaint->updated_at->format('d/m/Y H:i:s')) : 'Tidak Diketahui' ?></td>
                        </tr>
                        <tr>
                            <th>Status Disahkan</th>
                            <td><?= $complaint->is_validated ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-secondary">Tidak</span>'; ?></td>
                        </tr>
                        <?php if (!empty($complaint->attachment_path) || !empty($complaint->attachment_name)): ?>
                        <tr>
                            <th>Lampiran</th>
                            <td>
                                <?= $this->Html->link(
                                    h($complaint->attachment_name ?? 'Lihat Lampiran'),
                                    '/' . $complaint->attachment_path,
                                    ['target' => '_blank', 'class' => 'btn btn-sm btn-outline-primary']
                                ) ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Alamat Lokasi</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <?= $this->Text->autoParagraph(h($complaint->location_address)); ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Butiran Aduan</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary mb-0">
                        <i class="fas fa-file-alt me-2"></i>
                        <?= $this->Text->autoParagraph(h($complaint->details)); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card sticky-top" style="position: sticky; top: 90px;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Pilihan</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <?php 
                        $authUser = $this->getRequest()->getSession()->read('Auth');
                        $userType = $authUser && isset($authUser->user_type) ? $authUser->user_type : 'public';
                        
                        // Show admin actions only for officers
                        if ($authUser && isset($authUser->user_type) && $authUser->user_type === 'officer'): ?>
                            <?= $this->Html->link('<i class="fas fa-edit me-2"></i>Kemaskini', ['action' => 'edit', $complaint->complaint_id], ['class' => 'btn-pilihan btn-pilihan-warning mb-2', 'escape' => false]) ?>
                            <?= $this->Form->postLink('<i class="fas fa-trash me-2"></i>Padam', ['action' => 'delete', $complaint->complaint_id], [
                                'method' => 'delete',
                                'confirm' => __('Adakah anda pasti mahu memadam aduan # {0}?', $complaint->complaint_id),
                                'class' => 'btn-pilihan btn-pilihan-danger mb-2',
                                'escape' => false
                            ]) ?>
                        <?php endif; ?>
                        
                        <?php if ($userType === 'public'): ?>
                            <?= $this->Html->link('<i class="fas fa-edit me-2"></i>Kemaskini Aduan', ['action' => 'edit', $complaint->complaint_id], ['class' => 'btn-pilihan btn-pilihan-warning mb-2', 'escape' => false]) ?>
                        <?php endif; ?>
                        
                        <?= $this->Html->link('<i class="fas fa-arrow-left me-2"></i>Kembali', ['action' => 'index'], ['class' => 'btn-pilihan btn-pilihan-primary mb-2', 'escape' => false]) ?>
                        <?= $this->Html->link('<i class="fas fa-list me-2"></i>Senarai Aduan', ['action' => 'index'], ['class' => 'btn-pilihan btn-pilihan-secondary mb-2', 'escape' => false]) ?>
                    </div>
                    
                    <?php 
                    if ($authUser && isset($authUser->user_type) && $authUser->user_type === 'public'): ?>
                        <div class="d-grid gap-2 mt-3">
                            <?= $this->Html->link('<i class="fas fa-plus-circle me-2"></i>Buat Aduan Baru', ['action' => 'add'], ['class' => 'btn-pilihan btn-pilihan-success', 'escape' => false]) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.btn-pilihan {
    display: inline-block;
    width: 100%;
    padding: 0.75rem 1rem;
    border: none;
    border-radius: 1.5rem;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.875rem;
}

.btn-pilihan:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-pilihan:active {
    transform: translateY(0);
}

.btn-pilihan-warning {
    background-color: #fbbf24;
    color: #1f2937;
}

.btn-pilihan-warning:hover {
    background-color: #f59e0b;
    color: #1f2937;
}

.btn-pilihan-danger {
    background-color: #ef4444;
    color: white;
}

.btn-pilihan-danger:hover {
    background-color: #dc2626;
    color: white;
}

/* Primary Button (Blue) */
.btn-pilihan-primary {
    background-color: #3b82f6;
    color: white;
    border: 2px solid #3b82f6;
}

.btn-pilihan-primary:hover {
    background-color: #2563eb;
    border-color: #2563eb;
    color: white;
}

/* Secondary Button (Gray) */
.btn-pilihan-secondary {
    background-color: #e5e7eb;
    color: #374151;
    border: 2px solid #d1d5db;
}

.btn-pilihan-secondary:hover {
    background-color: #d1d5db;
    border-color: #9ca3af;
    color: #1f2937;
}

/* Success Button (Green) */
.btn-pilihan-success {
    background-color: #10b981;
    color: white;
}

.btn-pilihan-success:hover {
    background-color: #059669;
    color: white;
}

/* Shared hover animation */
.btn-pilihan:hover {
    animation: pilihan-hover 0.3s ease;
}

@keyframes pilihan-hover {
    0% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-2px);
    }
    100% {
        transform: translateY(-2px);
    }
}
</style>
