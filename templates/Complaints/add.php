<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Complaint $complaint
 */
?>
<div class="container-fluid">
    <div class="page-header">
        <h1><i class="fas fa-plus-circle me-3"></i>Buat Aduan Baru</h1>
        <p class="text-muted">Sila isi maklumat aduan anda dengan teliti</p>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="executive-card">
                <div class="step-indicators">
                    <div class="step-item active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Maklumat Asas</div>
                    </div>
                    <div class="step-item" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Perincian</div>
                    </div>
                    <div class="step-item" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Pengesahan</div>
                    </div>
                </div>

                <?= $this->Form->create($complaint, ['id' => 'complaint-form']) ?>
                <div class="form-steps">
                    <div class="step-content" id="step1" style="display: block;">
                        <h3 class="step-title">Maklumat Asas</h3>
                        <p class="step-description">Sila berikan maklumat asas mengenai aduan anda</p>
                        
                        <div class="form-group-executive">
                            <label class="form-label-executive">Tajuk Aduan <span class="text-danger">*</span></label>
                            <?= $this->Form->control('complaint_title', [
                                'label' => false,
                                'class' => 'form-control-executive',
                                'required' => true,
                                'placeholder' => 'Masukkan tajuk aduan',
                                'id' => 'complaint-title'
                            ]) ?>
                            <div class="invalid-feedback">Sila masukkan tajuk aduan</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-executive">
                                    <label class="form-label-executive">Kategori <span class="text-danger">*</span></label>
                                    <?= $this->Form->control('category_id', [
                                        'options' => $categories,
                                        'label' => false,
                                        'class' => 'form-control-executive',
                                        'required' => true,
                                        'empty' => '-- Pilih Kategori --',
                                        'id' => 'category-id'
                                    ]) ?>
                                    <div class="invalid-feedback">Sila pilih kategori</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-executive">
                                    <label class="form-label-executive">Keutamaan <span class="text-danger">*</span></label>
                                    <?= $this->Form->control('priority_id', [
                                        'options' => $priorities,
                                        'label' => false,
                                        'class' => 'form-control-executive',
                                        'required' => true,
                                        'empty' => '-- Pilih Keutamaan --',
                                        'id' => 'priority-id'
                                    ]) ?>
                                    <div class="invalid-feedback">Sila pilih keutamaan</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-executive" onclick="nextStep(2)">
                                Seterusnya <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="step-content" id="step2" style="display: none;">
                        <h3 class="step-title">Perincian Aduan</h3>
                        <p class="step-description">Berikan butiran lanjut mengenai aduan anda</p>
                        
                        <div class="form-group-executive">
                            <label class="form-label-executive">Keterangan Aduan <span class="text-danger">*</span></label>
                            <?= $this->Form->control('details', [
                                'label' => false,
                                'class' => 'form-control-executive',
                                'required' => true,
                                'placeholder' => 'Huraikan secara terperinci mengenai aduan anda',
                                'rows' => 5,
                                'id' => 'complaint-description'
                            ]) ?>
                            <div class="invalid-feedback">Sila masukkan keterangan aduan</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-executive">
                                    <label class="form-label-executive">Lokasi <span class="text-danger">*</span></label>
                                    <?= $this->Form->control('location_address', [
                                        'label' => false,
                                        'class' => 'form-control-executive',
                                        'required' => true,
                                        'placeholder' => 'Masukkan lokasi sebenar',
                                        'id' => 'location'
                                    ]) ?>
                                    <div class="invalid-feedback">Sila masukkan lokasi</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-executive">
                                    <label class="form-label-executive">Daerah <span class="text-danger">*</span></label>
                                    <?= $this->Form->control('district', [
                                        'options' => $districts,
                                        'label' => false,
                                        'class' => 'form-control-executive',
                                        'required' => true,
                                        'empty' => '-- Pilih Daerah --',
                                        'id' => 'district'
                                    ]) ?>
                                    <div class="invalid-feedback">Sila pilih daerah</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group-executive">
                            <label class="form-label-executive">Lampiran (Opsional)</label>
                            <?= $this->Form->control('attachment', [
                                'label' => false,
                                'type' => 'file',
                                'class' => 'form-control-executive',
                                'accept' => 'image/*,.pdf,.doc,.docx',
                                'id' => 'attachment'
                            ]) ?>
                            <small class="text-muted">Format yang dibenarkan: JPG, PNG, PDF, DOC, DOCX (Saiz maks: 5MB)</small>
                        </div>        
                        
                        <div class="form-actions">
                            <button type="button" class="btn-glass" onclick="previousStep(1)">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </button>
                            <button type="button" class="btn-executive" onclick="nextStep(3)">
                                Seterusnya <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="step-content" id="step3" style="display: none;">
                        <h3 class="step-title">Pengesahan</h3>
                        <p class="step-description">Sahkan semula maklumat aduan anda</p>
                        
                        <div class="confirmation-summary">
                            <div class="summary-item">
                                <label>Tajuk Aduan:</label>
                                <span id="confirm-title">-</span>
                            </div>
                            <div class="summary-item">
                                <label>Kategori:</label>
                                <span id="confirm-category">-</span>
                            </div>
                            <div class="summary-item">
                                <label>Keutamaan:</label>
                                <span id="confirm-priority">-</span>
                            </div>
                            <div class="summary-item">
                                <label>Lokasi:</label>
                                <span id="confirm-location">-</span>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn-glass" onclick="previousStep(2)">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </button>
                            <?= $this->Form->button('Hantar Aduan', [
                                'type' => 'submit',
                                'class' => 'btn-executive btn-gold'
                            ]) ?>
                        </div>
                    </div>
                    
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function nextStep(step) {
    // Validate current step before proceeding
    if (step === 2) {
        const currentStep = 1;
        if (!validateStep(currentStep)) {
            return;
        }
    } else if (step === 3) {
        const currentStep = 2;
        if (!validateStep(currentStep)) {
            return;
        }
    }
    
    // Hide all steps
    document.querySelectorAll('.step-content').forEach(el => el.style.display = 'none');
    
    // Remove active class from all step items
    document.querySelectorAll('.step-item').forEach(el => el.classList.remove('active'));
    
    // Mark previous steps as completed
    for (let i = 1; i < step; i++) {
        document.querySelector(`.step-item[data-step="${i}"]`).classList.add('completed');
    }
    
    // Show current step
    document.getElementById('step' + step).style.display = 'block';
    
    // Add active class to current step item
    document.querySelector(`.step-item[data-step="${step}"]`).classList.add('active');
    
    // Update confirmation summary if going to step 3
    if (step === 3) {
        updateConfirmationSummary();
    }
}

function previousStep(step) {
    // Remove completed class from steps after current
    for (let i = step + 1; i <= 3; i++) {
        document.querySelector(`.step-item[data-step="${i}"]`).classList.remove('completed');
    }
    
    // Hide all steps
    document.querySelectorAll('.step-content').forEach(el => el.style.display = 'none');
    
    // Remove active class from all step items
    document.querySelectorAll('.step-item').forEach(el => el.classList.remove('active'));
    
    // Show current step
    document.getElementById('step' + step).style.display = 'block';
    
    // Add active class to current step item
    document.querySelector(`.step-item[data-step="${step}"]`).classList.add('active');
}

function validateStep(step) {
    let isValid = true;
    
    if (step === 1) {
        const title = document.getElementById('complaint-title');
        const category = document.getElementById('category-id');
        const priority = document.getElementById('priority-id');
        
        if (!title.value.trim()) {
            title.classList.add('is-invalid');
            isValid = false;
        } else {
            title.classList.remove('is-invalid');
        }
        
        if (!category.value) {
            category.classList.add('is-invalid');
            isValid = false;
        } else {
            category.classList.remove('is-invalid');
        }
        
        if (!priority.value) {
            priority.classList.add('is-invalid');
            isValid = false;
        } else {
            priority.classList.remove('is-invalid');
        }
    } else if (step === 2) {
        const description = document.getElementById('complaint-description');
        const location = document.getElementById('location');
        const district = document.getElementById('district');
        
        if (!description.value.trim()) {
            description.classList.add('is-invalid');
            isValid = false;
        } else {
            description.classList.remove('is-invalid');
        }
        
        if (!location.value.trim()) {
            location.classList.add('is-invalid');
            isValid = false;
        } else {
            location.classList.remove('is-invalid');
        }
        
        if (!district.value) {
            district.classList.add('is-invalid');
            isValid = false;
        } else {
            district.classList.remove('is-invalid');
        }
    }
    
    return isValid;
}

function updateConfirmationSummary() {
    const title = document.getElementById('complaint-title').value || '-';
    const category = document.getElementById('category-id');
    const priority = document.getElementById('priority-id');
    const location = document.getElementById('location').value || '-';
    
    document.getElementById('confirm-title').textContent = title;
    document.getElementById('confirm-category').textContent = category.options[category.selectedIndex]?.text || '-';
    document.getElementById('confirm-priority').textContent = priority.options[priority.selectedIndex]?.text || '-';
    document.getElementById('confirm-location').textContent = location;
}

// Form validation on submit
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('complaint-form');
    if (form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }
    
    // Clear validation on input
    document.querySelectorAll('.form-control-executive').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>

<style>
/* Page Header */
.page-header {
    margin-bottom: 2rem;
    padding: 1.5rem 0;
    border-bottom: 3px solid #f0f0f0;
}

.page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a2332;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.page-header p {
    font-size: 1rem;
    color: #6b7280;
    margin: 0;
}

/* Executive Card Container */
.executive-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    padding: 2.5rem;
    margin-bottom: 2rem;
}

/* Step Indicators */
.step-indicators {
    display: flex;
    justify-content: space-between;
    margin-bottom: 3rem;
    position: relative;
    padding-bottom: 2rem;
}

.step-indicators::before {
    content: '';
    position: absolute;
    top: 25px;
    left: 0;
    right: 0;
    height: 2px;
    background: #e5e7eb;
    z-index: 0;
}

.step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 1;
    cursor: pointer;
}

.step-number {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #f3f4f6;
    border: 3px solid #d1d5db;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    color: #6b7280;
    margin-bottom: 0.75rem;
    transition: all 0.3s ease;
}

.step-item.active .step-number {
    background: #3b82f6;
    border-color: #3b82f6;
    color: white;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.step-item.completed .step-number {
    background: #10b981;
    border-color: #10b981;
    color: white;
}

.step-label {
    font-size: 0.95rem;
    font-weight: 600;
    color: #6b7280;
    text-align: center;
}

.step-item.active .step-label {
    color: #3b82f6;
    font-weight: 700;
}

.step-item.completed .step-label {
    color: #10b981;
}

/* Form Steps */
.step-content {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.step-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a2332;
    margin-bottom: 0.5rem;
}

.step-description {
    color: #6b7280;
    font-size: 1rem;
    margin-bottom: 2rem;
}

/* Form Groups */
.form-group-executive {
    margin-bottom: 1.5rem;
}

.form-label-executive {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-control-executive {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    font-family: inherit;
    background-color: #f9fafb;
}

.form-control-executive:focus {
    outline: none;
    border-color: #3b82f6;
    background-color: white;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-control-executive.is-invalid {
    border-color: #ef4444;
    background-color: #fef2f2;
}

textarea.form-control-executive {
    resize: vertical;
    min-height: 120px;
}

select.form-control-executive {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23374151' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    padding-right: 2.5rem;
}

/* Confirmation Summary */
.confirmation-summary {
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: 1rem 0;
    border-bottom: 1px solid #e5e7eb;
}

.summary-item:last-child {
    border-bottom: none;
}

.summary-item label {
    font-weight: 600;
    color: #374151;
}

.summary-item span {
    color: #1a2332;
    font-weight: 500;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2.5rem;
    padding-top: 2rem;
    border-top: 2px solid #f0f0f0;
}

.form-actions button {
    flex: 1;
    padding: 0.875rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

/* Primary Button */
.btn-executive {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn-executive:hover {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
}

.btn-executive:active {
    transform: translateY(0);
}

/* Secondary Glass Button */
.btn-glass {
    background: rgba(229, 231, 235, 0.5);
    color: #374151;
    border: 2px solid #e5e7eb;
    backdrop-filter: blur(10px);
}

.btn-glass:hover {
    background: rgba(209, 213, 219, 0.7);
    border-color: #9ca3af;
    transform: translateY(-2px);
}

/* Gold Button */
.btn-gold {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
}

.btn-gold:hover {
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
}

.btn-gold:active {
    transform: translateY(0);
}

/* Validation Messages */
.invalid-feedback {
    display: block;
    color: #ef4444;
    font-size: 0.85rem;
    margin-top: 0.25rem;
}

/* Responsive */
@media (max-width: 768px) {
    .executive-card {
        padding: 1.5rem;
    }
    
    .step-indicators {
        flex-direction: column;
        gap: 1.5rem;
        padding-bottom: 0;
    }
    
    .step-indicators::before {
        display: none;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .page-header h1 {
        font-size: 1.75rem;
    }
}
</style>