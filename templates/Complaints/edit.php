<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Complaint $complaint
 * @var string[]|\Cake\Collection\CollectionInterface $complainants
 * @var string[]|\Cake\Collection\CollectionInterface $categories
 * @var string[]|\Cake\Collection\CollectionInterface $statuses
 * @var string[]|\Cake\Collection\CollectionInterface $priorities
 * @var string[]|\Cake\Collection\CollectionInterface $officers
 * @var array $districts
 */
?>
<div class="container-fluid">
    <div class="page-header">
        <h1><i class="fas fa-edit me-3"></i>Kemaskini Aduan</h1>
        <p class="text-muted">Kemaskini maklumat aduan anda</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Butiran Aduan</h5>
                </div>
                <div class="card-body">
                    <?php
                    $authUser = $this->getRequest()->getSession()->read('Auth');
                    $userType = $authUser && isset($authUser->user_type) ? $authUser->user_type : 'public';
                    $isAdminOrOfficer = $authUser && isset($authUser->user_type) && $authUser->user_type === 'officer';
                    
                    // Allow public users to edit their own complaints, admins/officers to edit all
                    $canEdit = ($userType === 'public') || $isAdminOrOfficer;
                    
                    if (!$canEdit) {
                        echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Anda tidak dibenarkan untuk mengemaskini aduan ini.</div>';
                    } else {
                        echo $this->Form->create($complaint);
                    ?>

                    <div class="form-section">
                        <h6 class="section-title">Maklumat Aduan (Tidak Boleh Diedit)</h6>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>No. Aduan</label>
                                <p><?= h($complaint->complaint_no) ?></p>
                            </div>
                            <div class="info-item">
                                <label>Tajuk Aduan</label>
                                <p><?= h($complaint->complaint_title ?? 'Tidak Diketahui') ?></p>
                            </div>
                            <div class="info-item">
                                <label>Pengadu</label>
                                <p><?= ($complaint->hasValue('complainant') ? h($complaint->complainant->full_name) : 'Tidak Diketahui') ?></p>
                            </div>
                            <div class="info-item">
                                <label>Kategori</label>
                                <p><?= ($complaint->hasValue('category') ? h($complaint->category->category_name) : 'Tidak Diketahui') ?></p>
                            </div>
                            <div class="info-item">
                                <label>Keutamaan</label>
                                <p><?= ($complaint->hasValue('priority') ? h($complaint->priority->priority_label) : 'Tidak Diketahui') ?></p>
                            </div>
                            <div class="info-item">
                                <label>Status</label>
                                <p><?= ($complaint->hasValue('status') ? h($complaint->status->status_name) : 'Tidak Diketahui') ?></p>
                            </div>
                            <div class="info-item">
                                <label>Daerah</label>
                                <p><?= h($complaint->district) ?></p>
                            </div>
                            <div class="info-item">
                                <label>Lokasi</label>
                                <p><?= h($complaint->location_address) ?></p>
                            </div>
                        </div>
                        <div class="info-item full-width">
                            <label>Butiran Aduan</label>
                            <p><?= nl2br(h($complaint->details)) ?></p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-section">
                        <h6 class="section-title">Kemaskini Aduan</h6>
                        
                        <?php if ($isAdminOrOfficer): ?>
                            <div class="form-group">
                                <label>Pegawai Bertanggungjawab</label>
                                <?= $this->Form->control('officer_id', [
                                    'options' => $officers, 
                                    'empty' => '-- Pilih Pegawai --', 
                                    'label' => false,
                                    'required' => false,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>

                            <div class="form-group">
                                <label>Tarikh Akhir</label>
                                <?= $this->Form->control('deadline_at', [
                                    'empty' => true, 
                                    'label' => false,
                                    'type' => 'datetime-local', 
                                    'value' => $complaint->deadline_at ? $complaint->deadline_at->format('Y-m-d\TH:i') : '',
                                    'class' => 'form-control'
                                ]) ?>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <?= $this->Form->control('status_id', [
                                    'options' => $statuses,
                                    'empty' => '-- Pilih Status --',
                                    'label' => false,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Anda hanya boleh mengemaskini maklumat asas aduan anda.
                            </div>

                            <div class="form-group">
                                <label>Lokasi</label>
                                <?= $this->Form->control('location_address', [
                                    'label' => false,
                                    'class' => 'form-control',
                                    'placeholder' => 'Lokasi kejadian'
                                ]) ?>
                            </div>

                            <div class="form-group">
                                <label>Daerah</label>
                                <?= $this->Form->control('district', [
                                    'options' => [
                                        'SPU' => 'Seberang Perai Utara',
                                        'SPT' => 'Seberang Perai Tengah', 
                                        'SPS' => 'Seberang Perai Selatan'
                                    ],
                                    'label' => false,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>

                            <div class="form-group">
                                <label>Butiran Aduan</label>
                                <?= $this->Form->control('details', [
                                    'type' => 'textarea',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'rows' => 5,
                                    'placeholder' => 'Huraikan aduan anda'
                                ]) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                    echo $this->Form->hidden('complaint_no');
                    echo $this->Form->hidden('complaint_title');
                    echo $this->Form->hidden('complainant_id');
                    echo $this->Form->hidden('category_id');
                    echo $this->Form->hidden('priority_id');
                    if ($isAdminOrOfficer) {
                        // Officers can update status, so don't hide it
                    } else {
                        echo $this->Form->hidden('status_id');
                    }
                    echo $this->Form->hidden('is_validated');
                    echo $this->Form->hidden('created_at', ['value' => $complaint->created_at ? $complaint->created_at->format('Y-m-d H:i:s') : '']);
                    ?>

                    <div class="form-actions mt-4">
                        <?= $this->Form->button('<i class="fas fa-save me-2"></i>Simpan Perubahan', [
                            'type' => 'submit',
                            'class' => 'btn-pilihan btn-pilihan-success',
                            'escape' => false
                        ]) ?>
                        <?= $this->Html->link('<i class="fas fa-times me-2"></i>Batal', ['action' => 'view', $complaint->complaint_id], [
                            'class' => 'btn-pilihan btn-pilihan-secondary',
                            'escape' => false
                        ]) ?>
                    </div>

                    <?= $this->Form->end() ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card sticky-top" style="position: sticky; top: 90px;">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>Pilihan</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <?= $this->Html->link('<i class="fas fa-arrow-left me-2"></i>Kembali', ['action' => 'view', $complaint->complaint_id], [
                            'class' => 'btn-pilihan btn-pilihan-primary mb-2',
                            'escape' => false
                        ]) ?>
                        <?= $this->Html->link('<i class="fas fa-list me-2"></i>Senarai Aduan', ['action' => 'index'], [
                            'class' => 'btn-pilihan btn-pilihan-secondary mb-2',
                            'escape' => false
                        ]) ?>
                        <?php if ($authUser && isset($authUser->user_type) && $authUser->user_type === 'public'): ?>
                            <?= $this->Html->link('<i class="fas fa-plus-circle me-2"></i>Buat Aduan Baru', ['action' => 'add'], [
                                'class' => 'btn-pilihan btn-pilihan-success',
                                'escape' => false
                            ]) ?>
                        <?php endif; ?>
                    </div>
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

/* Danger Button (Red) */
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

.form-section {
    margin-bottom: 2rem;
}

.section-title {
    color: #3b82f6;
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.1rem;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 0.5rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.info-item {
    padding: 0.75rem;
    background: #f9fafb;
    border-radius: 0.5rem;
    border-left: 3px solid #3b82f6;
}

.info-item.full-width {
    grid-column: 1 / -1;
}

.info-item label {
    font-weight: 600;
    color: #374151;
    display: block;
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-item p {
    margin: 0;
    color: #1f2937;
}

.form-actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    border-radius: 0.375rem;
    font-weight: 500;
    padding: 0.5rem 1rem;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background: #3b82f6;
    color: white;
    border: 1px solid #3b82f6;
}

.btn-primary:hover {
    background: #2563eb;
    border-color: #2563eb;
}

.btn-secondary {
    background: #6b7280;
    color: white;
    border: 1px solid #6b7280;
}

.btn-secondary:hover {
    background: #4b5563;
    border-color: #4b5563;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    font-weight: 600;
    display: block;
    margin-bottom: 0.5rem;
    color: #374151;
}

.form-control {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.5rem 0.75rem;
    width: 100%;
}

.form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}
</style>
