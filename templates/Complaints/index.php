<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Complaint> $complaints
 */
?>
<?php
$authUser = $this->getRequest()->getSession()->read('Auth');

// Safety check: default user_type to 'public' if not set
$userType = 'public';
if ($authUser && isset($authUser->user_type)) {
    $userType = $authUser->user_type;
}

$isUser = $userType === 'public';
$isAdmin = false;
$isOfficer = $userType === 'officer';
if ($authUser) {
    $isAdmin = ($isOfficer) && (isset($authUser->role) && $authUser->role === 'admin');
}
?>
<div class="complaints-dashboard">
    <div class="bento-grid bento-grid-lg">
        <div class="bento-card-sm animate-fade-in-up stagger-1">
            <div class="stat-tile">
                <div class="stat-number" data-target="<?= $totalComplaints ?>"><?= $totalComplaints ?></div>
                <div class="stat-label">Jumlah Aduan</div>
                <div class="stat-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+12% dari bulan lalu</span>
                </div>
            </div>
        </div>
        
        <div class="bento-card-sm animate-fade-in-up stagger-2">
            <div class="stat-tile">
                <div class="stat-number" data-target="<?= $inProgress ?>"><?= $inProgress ?></div>
                <div class="stat-label">Dalam Proses</div>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+3 dari semalam</span>
                </div>
            </div>
        </div>
        
        <div class="bento-card-sm animate-fade-in-up stagger-3">
            <div class="stat-tile">
                <div class="stat-number" data-target="<?= $completed ?>"><?= $completed ?></div>
                <div class="stat-label">Selesai</div>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+5 dari minggu lalu</span>
                </div>
            </div>
        </div>
        
        <div class="bento-card-sm animate-fade-in-up stagger-4">
            <div class="stat-tile">
                <div class="stat-number" data-target="<?= $pending ?>"><?= $pending ?></div>
                <div class="stat-label">Menunggu</div>
                <div class="stat-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-trend negative">
                    <i class="fas fa-arrow-down"></i>
                    <span>-2 dari semalam</span>
                </div>
            </div>
        </div>
        
        <div class="bento-card-lg animate-fade-in-up stagger-6">
            <div class="executive-card">
                <div class="executive-card-header">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Senarai Aduan
                </div>
                <div class="executive-card-body">
                    <?php if ($isUser): ?>
                        <div class="text-end mb-3">
                            <?= $this->Html->link(__('Buat Aduan Baru'), ['action' => 'add'], ['class' => 'btn btn-gold']) ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="mb-4">
                        <?= $this->Form->create(null, ['type' => 'get', 'url' => ['action' => 'index']]) ?>
                        <div class="row">
                            <div class="col-md-10">
                                <?= $this->Form->control('search', [
                                    'type' => 'text',
                                    'label' => false,
                                    'placeholder' => 'Cari mengikut No. Aduan, Tajuk, atau Nama Pengadu...',
                                    'value' => $search ?? '',
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $this->Form->button('Cari', ['class' => 'btn btn-primary w-100']) ?>
                            </div>
                        </div>
                        <?php if (!empty($search)): ?>
                            <div class="text-end mt-3">
                                <?= $this->Html->link(__('Batalkan'), ['action' => 'index'], ['class' => 'btn btn-outline']) ?>
                            </div>
                        <?php endif; ?>
                        <?= $this->Form->end() ?>
                    </div>
                    
                    <?php if (empty($complaints->toArray())): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tiada rekod dijumpai</h5>
                            <p class="text-muted">Tiada aduan yang sepadan dengan kriteria carian anda.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="executive-table">
                                <thead>
                                    <tr>
                                        <th>No. Aduan</th>
                                        <th>Tajuk</th>
                                        <th>Status</th>
                                        <th>Keutamaan</th>
                                        <?php if (!$isUser): ?>
                                            <th>Tindakan</th>
                                        <?php else: ?>
                                            <th>Lihat Lanjut</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($complaints as $complaint): ?>
                                    <tr>
                                        <td>
                                            <?php if ($isUser): ?>
                                                <?= h($complaint->complaint_no) ?>
                                            <?php else: ?>
                                                <?= $this->Html->link(h($complaint->complaint_no), ['action' => 'view', $complaint->complaint_id]) ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= h($complaint->complaint_title ?? 'Tidak Diketahui') ?></td>
                                        <td>
                                            <?php if ($complaint->hasValue('status')): ?>
                                                <span class="badge-executive badge-navy"><?= h($complaint->status->status_name) ?></span>
                                            <?php else: ?>
                                                <span class="badge-executive">Tidak Diketahui</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php 
                                            $priorityLabel = $complaint->hasValue('priority') ? $complaint->priority->priority_label : '';
                                            $badgeClass = 'badge-executive';
                                            if (stripos($priorityLabel, 'Tinggi') !== false) {
                                                $badgeClass = 'badge-executive badge-danger';
                                            } elseif (stripos($priorityLabel, 'Sederhana') !== false) {
                                                $badgeClass = 'badge-executive badge-warning';
                                            } elseif (stripos($priorityLabel, 'Biasa') !== false) {
                                                $badgeClass = 'badge-executive badge-success';
                                            }
                                            ?>
                                            <span class="<?= $badgeClass ?>"><?= h($priorityLabel) ?></span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <?php if ($isUser): ?>
                                                    <?= $this->Html->link('<i class="fas fa-arrow-right"></i>', ['action' => 'view', $complaint->complaint_id], ['class' => 'btn-glass btn-sm', 'title' => 'Lihat Lanjut', 'escape' => false]) ?>
                                                <?php else: ?>
                                                    <?= $this->Html->link('<i class="fas fa-eye"></i>', ['action' => 'view', $complaint->complaint_id], ['class' => 'btn-glass btn-sm', 'title' => 'Lihat', 'escape' => false]) ?>
                                                    <?php if ($isAdmin): ?>
                                                        <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $complaint->complaint_id], ['class' => 'btn-glass btn-sm', 'title' => 'Kemaskini', 'escape' => false]) ?>
                                                        <?= $this->Form->postLink('<i class="fas fa-trash"></i>', ['action' => 'delete', $complaint->complaint_id], [
                                                            'method' => 'delete',
                                                            'confirm' => __('Adakah anda pasti mahu memadam aduan # {0}?', $complaint->complaint_id),
                                                            'class' => 'btn-glass btn-sm',
                                                            'title' => 'Padam',
                                                            'escape' => false
                                                        ]) ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                <?= $this->Paginator->counter('Mengandungi {{current}} daripada {{count}} rekod') ?>
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <?= $this->Paginator->first('<< Pertama') ?>
                                    <?= $this->Paginator->prev('< Sebelum') ?>
                                    <?= $this->Paginator->numbers() ?>
                                    <?= $this->Paginator->next('Seterusnya >') ?>
                                    <?= $this->Paginator->last('Terakhir >>') ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php if ($isAdmin && isset($chartLabels) && !empty($chartLabels)): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const statusCtx = document.getElementById('statusPieChart');
    if (statusCtx) {
        new Chart(statusCtx.getContext('2d'), {
            type: 'pie',
            data: {
                labels: <?= json_encode($chartLabels) ?>,
                datasets: [{
                    data: <?= json_encode($chartData) ?>,
                    backgroundColor: [
                        '#3b82f6',
                        '#fbbf24',
                        '#10b981',
                        '#ef4444',
                        '#8b5cf6',
                        '#f59e0b'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { 
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: { size: 12 }
                        }
                    }
                }
            }
        });
    }
    
    // Priority Bar Chart
    <?php if (isset($priorityLabels) && !empty($priorityLabels)): ?>
    const priorityCtx = document.getElementById('priorityBarChart');
    if (priorityCtx) {
        new Chart(priorityCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($priorityLabels) ?>,
                datasets: [{
                    label: 'Bilangan Aduan',
                    data: <?= json_encode($priorityData) ?>,
                    backgroundColor: [
                        '#10b981', // Green for Biasa
                        '#ef4444', // Red for Kritikal
                        '#f59e0b'  // Orange for Sederhana
                    ],
                    borderColor: [
                        '#059669',
                        '#dc2626',
                        '#d97706'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false
                    }
                }
            }
        });
    }
    <?php endif; ?>
</script>
<?php endif; ?>
