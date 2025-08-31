<?= $this->extend('layouts/admin.php'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-edit me-2"></i>
                            <?= $judul ?>
                        </h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 bg-transparent">
                                <li class="breadcrumb-item">
                                    <a href="<?= url_to('diagnosis.index') ?>" class="text-dark">
                                        <i class="fa fa-list me-1"></i>Daftar Diagnosis
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Alert Messages -->
                    <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-circle me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-triangle me-2"></i>
                        <strong>Terdapat kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <form action="<?= url_to('diagnosis.update', $diagnosis['id']) ?>" method="POST" id="editForm">
                        <?= csrf_field() ?>

                        <div class="row">
                            <!-- Informasi Pasien -->
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">
                                            <i class="fa fa-user me-2"></i>
                                            Informasi Pasien
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="nama_pasien" class="form-label">
                                                <i class="fa fa-user me-1 text-primary"></i>
                                                Nama Petani <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control <?= session()->getFlashdata('errors')['nama_pasien'] ?? false ? 'is-invalid' : '' ?>"
                                                id="nama_pasien" name="nama_pasien"
                                                value="<?= old('nama_pasien', $diagnosis['nama_pasien']) ?>" required>
                                            <?php if (session()->getFlashdata('errors')['nama_pasien'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->getFlashdata('errors')['nama_pasien'] ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="alamat_lahan" class="form-label">
                                                <i class="fa fa-map-marker-alt me-1 text-primary"></i>
                                                Alamat Lahan
                                            </label>
                                            <textarea
                                                class="form-control <?= session()->getFlashdata('errors')['alamat_lahan'] ?? false ? 'is-invalid' : '' ?>"
                                                id="alamat_lahan" name="alamat_lahan"
                                                rows="3"><?= old('alamat_lahan', $diagnosis['alamat_lahan']) ?></textarea>
                                            <?php if (session()->getFlashdata('errors')['alamat_lahan'] ?? false): ?>
                                            <div class="invalid-feedback">
                                                <?= session()->getFlashdata('errors')['alamat_lahan'] ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="luas_lahan" class="form-label">
                                                <i class="fa fa-expand-arrows-alt me-1 text-primary"></i>
                                                Luas Lahan
                                            </label>
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control <?= session()->getFlashdata('errors')['luas_lahan'] ?? false ? 'is-invalid' : '' ?>"
                                                    id="luas_lahan" name="luas_lahan"
                                                    value="<?= old('luas_lahan', $diagnosis['luas_lahan']) ?>">
                                                <span class="input-group-text">Ha</span>
                                                <?php if (session()->getFlashdata('errors')['luas_lahan'] ?? false): ?>
                                                <div class="invalid-feedback">
                                                    <?= session()->getFlashdata('errors')['luas_lahan'] ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">
                                                <i class="fa fa-calendar me-1 text-primary"></i>
                                                Tanggal Diagnosis
                                            </label>
                                            <input type="text" class="form-control"
                                                value="<?= date('d/m/Y H:i:s', strtotime($diagnosis['tanggal_diagnosis'])) ?>"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Hasil Diagnosis -->
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">
                                            <i class="fa fa-diagnoses me-2"></i>
                                            Hasil Diagnosis
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <?php 
                                        $hasilDiagnosis = is_string($diagnosis['hasil_diagnosis']) 
                                            ? json_decode($diagnosis['hasil_diagnosis'], true) 
                                            : $diagnosis['hasil_diagnosis'];
                                        
                                        if ($hasilDiagnosis): 
                                            // Sort by percentage descending
                                            uasort($hasilDiagnosis, function($a, $b) {
                                                return ($b['percentage'] ?? 0) <=> ($a['percentage'] ?? 0);
                                            });
                                        ?>
                                        <div class="diagnosis-results">
                                            <?php foreach ($hasilDiagnosis as $kodePenyakit => $hasil): ?>
                                            <?php 
                                                    $percentage = $hasil['percentage'] ?? 0;
                                                    $badgeClass = 'secondary';
                                                    $statusText = 'Rendah';
                                                    
                                                    if ($percentage >= 70) {
                                                        $badgeClass = 'danger';
                                                        $statusText = 'Tinggi';
                                                    } elseif ($percentage >= 40) {
                                                        $badgeClass = 'warning';
                                                        $statusText = 'Sedang';
                                                    }
                                                    ?>
                                            <div class="card mb-3 border-<?= $badgeClass ?>">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <h6 class="card-title mb-0 text-<?= $badgeClass ?>">
                                                            <?= esc($hasil['name'] ?? $kodePenyakit) ?>
                                                        </h6>
                                                        <span class="badge bg-<?= $badgeClass ?> fs-6">
                                                            <?= number_format($percentage, 1) ?>%
                                                        </span>
                                                    </div>

                                                    <div class="row text-sm">
                                                        <div class="col-md-6">
                                                            <small class="text-muted">
                                                                <i class="fa fa-percentage me-1"></i>
                                                                CF Value: <?= number_format($hasil['cf'] ?? 0, 3) ?>
                                                            </small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <small class="text-muted">
                                                                <i class="fa fa-chart-line me-1"></i>
                                                                Tingkat: <?= $statusText ?>
                                                            </small>
                                                        </div>
                                                    </div>

                                                    <?php if (isset($hasil['matching_symptoms']) && isset($hasil['total_symptoms'])): ?>
                                                    <div class="mt-2">
                                                        <small class="text-muted">
                                                            <i class="fa fa-clipboard-list me-1"></i>
                                                            Gejala Cocok:
                                                            <?= $hasil['matching_symptoms'] ?>/<?= $hasil['total_symptoms'] ?>
                                                        </small>
                                                    </div>
                                                    <?php endif; ?>

                                                    <!-- Progress Bar -->
                                                    <div class="progress mt-2" style="height: 6px;">
                                                        <div class="progress-bar bg-<?= $badgeClass ?>"
                                                            role="progressbar" style="width: <?= $percentage ?>%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <!-- Diagnosis Summary -->
                                        <div class="alert alert-info">
                                            <h6 class="alert-heading">
                                                <i class="fa fa-info-circle me-2"></i>
                                                Ringkasan Diagnosis
                                            </h6>
                                            <p class="mb-2">
                                                <strong>Penyakit Terdiagnosis:</strong>
                                                <?= $diagnosis['penyakit_terdiagnosis'] ? 
                                                        '<span class="badge bg-primary">' . esc($diagnosis['penyakit_terdiagnosis']) . '</span>' : 
                                                        '<span class="text-muted">Tidak terdeteksi</span>' ?>
                                            </p>
                                            <p class="mb-0">
                                                <strong>Nilai CF Tertinggi:</strong>
                                                <?= $diagnosis['nilai_cf_tertinggi'] ? 
                                                        '<span class="badge bg-success">' . number_format($diagnosis['nilai_cf_tertinggi'] * 100, 1) . '%</span>' : 
                                                        '<span class="text-muted">-</span>' ?>
                                            </p>
                                        </div>

                                        <?php else: ?>
                                        <div class="alert alert-warning">
                                            <i class="fa fa-exclamation-triangle me-2"></i>
                                            Tidak ada hasil diagnosis ditemukan.
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rekomendasi (jika ada) -->
                        <?php if ($hasilDiagnosis): ?>
                        <?php 
                            $highConfidenceResults = array_filter($hasilDiagnosis, function($hasil) {
                                return ($hasil['percentage'] ?? 0) >= 40;
                            });
                            ?>

                        <?php if (!empty($highConfidenceResults)): ?>
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">
                                    <i class="fa fa-lightbulb me-2"></i>
                                    Rekomendasi Penanganan
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php foreach ($highConfidenceResults as $kodePenyakit => $hasil): ?>
                                <?php if (isset($hasil['recommendations']) && !empty($hasil['recommendations'])): ?>
                                <div class="mb-4">
                                    <h6 class="text-primary">
                                        <i class="fa fa-bug me-2"></i>
                                        <?= esc($hasil['name'] ?? $kodePenyakit) ?>
                                        <span
                                            class="badge bg-primary ms-2"><?= number_format($hasil['percentage'], 1) ?>%</span>
                                    </h6>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($hasil['recommendations'] as $rekomendasi): ?>
                                        <li class="list-group-item border-0 px-0">
                                            <i class="fa fa-check-circle text-success me-2"></i>
                                            <?= esc($rekomendasi) ?>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="btn-group" role="group">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="fa fa-save me-2"></i>
                                                Simpan Perubahan
                                            </button>

                                            <a href="<?= url_to('diagnosis.index') ?>" class="btn btn-secondary btn-lg">
                                                <i class="fa fa-times me-2"></i>
                                                Batal
                                            </a>

                                            <button type="button" class="btn btn-success btn-lg"
                                                onclick="printDiagnosis()">
                                                <i class="fa fa-print me-2"></i>
                                                Cetak
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.diagnosis-results .card {
    transition: transform 0.2s ease-in-out;
}

.diagnosis-results .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
}

.text-sm {
    font-size: 0.875rem;
}

.badge {
    font-size: 0.75em;
}

.list-group-item {
    background-color: transparent !important;
}

.card-header {
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
}

.btn-lg {
    padding: 0.75rem 2rem;
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
        width: 100%;
    }

    .btn-group .btn {
        margin-bottom: 0.5rem;
        border-radius: 0.375rem !important;
    }

    .diagnosis-results .card {
        margin-bottom: 1rem;
    }
}
</style>

<script>
// Form validation
document.getElementById('editForm').addEventListener('submit', function(e) {
    const namaPassien = document.getElementById('nama_pasien').value.trim();

    if (!namaPassien) {
        e.preventDefault();
        alert('Nama pasien harus diisi!');
        document.getElementById('nama_pasien').focus();
        return false;
    }

    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Menyimpan...';
    submitBtn.disabled = true;

    // Re-enable after 10 seconds to prevent permanent disable
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 10000);
});

// Print diagnosis
function printDiagnosis() {
    const diagnosisData = {
        nama_pasien: document.getElementById('nama_pasien').value,
        alamat_lahan: document.getElementById('alamat_lahan').value,
        luas_lahan: document.getElementById('luas_lahan').value,
        tanggal_diagnosis: '<?= $diagnosis['tanggal_diagnosis'] ?>',
        hasil_diagnosis: <?= json_encode($hasilDiagnosis ?? []) ?>
    };

    const printWindow = window.open('', '', 'width=800,height=600');
    const printContent = generatePrintContent(diagnosisData);

    printWindow.document.write(printContent);
    printWindow.document.close();
    printWindow.print();
}

// Generate print content
function generatePrintContent(data) {
    const results = data.hasil_diagnosis;

    // Sort results by percentage
    const sortedResults = Object.entries(results)
        .sort(([, a], [, b]) => (b.percentage || 0) - (a.percentage || 0));

    let resultsHtml = '';
    sortedResults.forEach(([code, result]) => {
        const percentage = result.percentage || 0;
        let confidenceText = 'Kemungkinan Rendah';

        if (percentage >= 70) {
            confidenceText = 'Kemungkinan Tinggi';
        } else if (percentage >= 40) {
            confidenceText = 'Kemungkinan Sedang';
        }

        resultsHtml += `
                <div style="margin-bottom: 2rem; padding: 1rem; border: 1px solid #ddd; border-radius: 8px;">
                    <h3>${result.name}</h3>
                    <p><strong>Persentase:</strong> ${percentage.toFixed(1)}%</p>
                    <p><strong>Tingkat Keyakinan:</strong> ${confidenceText}</p>
                    <p><strong>CF Value:</strong> ${(result.cf || 0).toFixed(3)}</p>
                    
                    ${result.matching_symptoms ? `
                        <p><strong>Gejala yang Cocok:</strong> ${result.matching_symptoms}/${result.total_symptoms}</p>
                    ` : ''}
                    
                    ${percentage >= 40 && result.recommendations && result.recommendations.length > 0 ? `
                        <h4>Rekomendasi Penanganan:</h4>
                        <ul>
                            ${result.recommendations.map(rec => `<li>${rec}</li>`).join('')}
                        </ul>
                    ` : ''}
                </div>
            `;
    });

    return `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Edit Diagnosis - ${data.nama_pasien}</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .header { text-align: center; margin-bottom: 30px; }
                    .patient-info { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
                    h1, h2, h3 { color: #1e40af; }
                    .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #666; }
                    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f8f9fa; }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>SISTEM PAKAR DIAGNOSIS PENYAKIT UBI JALAR</h1>
                    <h2>Hasil Diagnosis (Edit)</h2>
                </div>
                
                <div class="patient-info">
                    <h3>Informasi Pasien</h3>
                    <table>
                        <tr><td><strong>Nama Petani:</strong></td><td>${data.nama_pasien}</td></tr>
                        <tr><td><strong>Alamat Lahan:</strong></td><td>${data.alamat_lahan || '-'}</td></tr>
                        <tr><td><strong>Luas Lahan:</strong></td><td>${data.luas_lahan || '-'} Ha</td></tr>
                        <tr><td><strong>Tanggal Diagnosis:</strong></td><td>${new Date(data.tanggal_diagnosis).toLocaleDateString('id-ID')}</td></tr>
                    </table>
                </div>
                
                <h3>Hasil Diagnosis:</h3>
                ${resultsHtml}
                
                <div class="footer">
                    <p>Dicetak pada: ${new Date().toLocaleString('id-ID')}</p>
                    <p>Sistem Pakar Diagnosis Penyakit Ubi Jalar - Metode Certainty Factor</p>
                </div>
            </body>
            </html>
        `;
}

// Auto-save draft (optional feature)
let autoSaveTimer;
const formInputs = document.querySelectorAll('#editForm input, #editForm textarea');

formInputs.forEach(input => {
    input.addEventListener('input', function() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(saveDraft, 2000);
    });
});

function saveDraft() {
    const formData = new FormData(document.getElementById('editForm'));
    const draftData = {};

    for (let [key, value] of formData.entries()) {
        draftData[key] = value;
    }

    localStorage.setItem('diagnosis_edit_draft_<?= $diagnosis['id'] ?>', JSON.stringify(draftData));
}

// Load draft on page load
document.addEventListener('DOMContentLoaded', function() {
    const draftData = localStorage.getItem('diagnosis_edit_draft_<?= $diagnosis['id'] ?>');

    if (draftData) {
        const data = JSON.parse(draftData);

        Object.keys(data).forEach(key => {
            const input = document.querySelector(`[name="${key}"]`);
            if (input && input.value === input.defaultValue) {
                input.value = data[key];
                input.style.backgroundColor = '#fff3cd';
            }
        });
    }
});

// Clear draft after successful save
document.getElementById('editForm').addEventListener('submit', function() {
    localStorage.removeItem('diagnosis_edit_draft_<?= $diagnosis['id'] ?>');
});
</script>

<?= $this->endSection(); ?>