<?= $this->extend('layouts/admin.php'); ?>

<?= $this->section('content'); ?>

<!-- Added sweet potato plant banner section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="position-relative"
                    style="height: 200px; background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                    <img src="<?= base_url() ?>assets/images/walpaper.jpg" width="1200" height="200"
                        alt="Tanaman Ubi Jalar" class="w-100 h-100 object-cover position-absolute"
                        style="object-fit: cover; opacity: 0.3;">
                    <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
                        <h2 class="fw-bold mb-2">Sistem Pakar Diagnosis Penyakit Ubi Jalar</h2>
                        <p class="mb-0 fs-5">Masukkan gejala yang diamati untuk mendapatkan diagnosis menggunakan metode
                            Certainty Factor</p>
                        <div class="mt-3">
                            <span class="badge bg-light text-dark px-3 py-2 me-2">
                                <i class="fa fa-leaf me-1"></i> Teknologi Pertanian Modern
                            </span>
                            <span class="badge bg-light text-dark px-3 py-2">
                                <i class="fa fa-microscope me-1"></i> Diagnosis Akurat
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        color: #334155;
    }

    .header {
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 1rem 0;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .logo img {
        width: 50px;
        height: 50px;
    }

    .logo-text {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1e40af;
    }

    .nav-links {
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .nav-links a {
        text-decoration: none;
        color: #64748b;
        font-weight: 500;
        transition: color 0.3s;
    }

    .nav-links a:hover,
    .nav-links a.active {
        color: #1e40af;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-title {
        text-align: center;
        margin-bottom: 3rem;
    }

    .page-title h1 {
        font-size: 2.5rem;
        color: #1e40af;
        margin-bottom: 0.5rem;
    }

    .page-title p {
        color: #64748b;
        font-size: 1.1rem;
    }

    .diagnosis-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .symptoms-section,
    .patient-info {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 1.5rem;
        color: #1e40af;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #374151;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .symptom-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 1rem;
        background: #f8fafc;
    }

    .symptom-info {
        flex: 1;
    }

    .symptom-code {
        font-weight: 600;
        color: #1e40af;
        font-size: 0.9rem;
    }

    .symptom-name {
        color: #374151;
        margin-top: 0.25rem;
    }

    .symptom-input {
        width: 120px;
        margin-left: 1rem;
    }

    .btn {
        background: #3b82f6;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }

    .btn:disabled {
        background: #9ca3af;
        cursor: not-allowed;
        transform: none;
    }

    .btn-secondary {
        background: #64748b;
    }

    .btn-secondary:hover {
        background: #475569;
    }

    .btn-success {
        background: #059669;
    }

    .btn-success:hover {
        background: #047857;
    }

    .action-buttons {
        text-align: center;
        margin-top: 2rem;
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .results-section {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-top: 2rem;
        display: none;
    }

    .results-section.show {
        display: block;
    }

    .diagnosis-result {
        text-align: center;
        padding: 2rem;
        border-radius: 8px;
        margin-bottom: 2rem;
    }

    .diagnosis-result.high {
        background: #fee2e2;
        border: 2px solid #fca5a5;
    }

    .diagnosis-result.medium {
        background: #fef3c7;
        border: 2px solid #fcd34d;
    }

    .diagnosis-result.low {
        background: #dcfce7;
        border: 2px solid #86efac;
    }

    .cf-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .disease-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .confidence-level {
        font-size: 1.1rem;
        opacity: 0.8;
    }

    .recommendations {
        background: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 1rem;
    }

    .recommendations h4 {
        color: #0369a1;
        margin-bottom: 1rem;
    }

    .recommendations ul {
        list-style-type: none;
        padding: 0;
    }

    .recommendations li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #e0f2fe;
    }

    .recommendations li:last-child {
        border-bottom: none;
    }

    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 768px) {
        .diagnosis-container {
            grid-template-columns: 1fr;
        }

        .container {
            padding: 1rem;
        }

        .page-title h1 {
            font-size: 2rem;
        }

        .action-buttons {
            flex-direction: column;
            align-items: center;
        }

        .symptom-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .symptom-input {
            width: 100%;
            margin-left: 0;
        }
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <!-- Added modern alert styling -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show m-3 mb-0" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show m-3 mb-0" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Gagal!</strong> <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="diagnosis-container">
                        <div class="patient-info">
                            <h3 class="section-title">
                                <span>📋</span>
                                Informasi Pasien
                            </h3>
                            <form id="patientForm">
                                <div class="form-group">
                                    <label for="patientName">Nama Petani</label>
                                    <input type="text" id="patientName" name="patientName" required>
                                </div>
                                <div class="form-group">
                                    <label for="farmLocation">Alamat Lahan</label>
                                    <input type="text" id="farmLocation" name="farmLocation" required>
                                </div>
                                <div class="form-group">
                                    <label for="farmSize">Luas Lahan (Ha)</label>
                                    <input type="number" id="farmSize" name="farmSize" step="0.1" required>
                                </div>
                            </form>
                        </div>

                        <div class="symptoms-section">
                            <h3 class="section-title">
                                <span>🔍</span>
                                Input Nilai Gejala
                            </h3>
                            <p style="margin-bottom: 1.5rem; color: #64748b;">
                                Pilih tingkat keyakinan untuk setiap gejala yang diamati
                            </p>

                            <div id="symptomsContainer">
                                <!-- Symptoms will be populated by JavaScript -->
                                <div class="text-center">
                                    <div class="loading-spinner"></div>
                                    <p class="mt-2">Memuat data gejala...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button class="btn" onclick="performDiagnosis()" id="diagnosisBtn">
                            <span>🔬</span>
                            Lakukan Diagnosis
                        </button>
                        <button class="btn btn-secondary" onclick="resetForm()">
                            <span>🔄</span>
                            Reset Form
                        </button>
                        <button class="btn btn-success" onclick="saveDiagnosis()" id="saveBtn" style="display: none;">
                            <span>💾</span>
                            Simpan Hasil
                        </button>
                        <button class="btn btn-secondary" onclick="printResults()" id="printBtn" style="display: none;">
                            <span>🖨️</span>
                            Cetak Hasil
                        </button>
                    </div>

                    <div class="results-section" id="resultsSection">
                        <h3 class="section-title">
                            <span>📊</span>
                            Hasil Diagnosis
                        </h3>
                        <div id="diagnosisResults">
                            <!-- Results will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Global variables
    let symptomsData = [];
    let diseasesData = {};
    let currentDiagnosisResults = null;

    // Initialize page when DOM loaded
    document.addEventListener('DOMContentLoaded', function () {
        loadSymptomsData();
    });

    // Load symptoms data from server
    function loadSymptomsData() {
        fetch('<?= url_to('diagnosis.symptoms') ?>')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    symptomsData = data.data;
                    initializeSymptoms();
                } else {
                    showAlert('error', 'Gagal memuat data gejala: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan saat memuat data gejala');
            });
    }

    // Initialize symptoms form
    function initializeSymptoms() {
        const container = document.getElementById('symptomsContainer');
        container.innerHTML = '';

        // Group symptoms by code (remove duplicates)
        const uniqueSymptoms = {};
        symptomsData.forEach(symptom => {
            if (!uniqueSymptoms[symptom.kode_gejala]) {
                uniqueSymptoms[symptom.kode_gejala] = symptom;
            }
        });

        Object.values(uniqueSymptoms).forEach(symptom => {
            const cf = symptom.cf ? parseFloat(symptom.cf).toFixed(3) : '0.000';
            const symptomDiv = document.createElement('div');
            symptomDiv.className = 'symptom-item';
            symptomDiv.innerHTML = `
                <div class="symptom-info">
                    <div class="symptom-code">${symptom.kode_gejala}</div>
                    <div class="symptom-name">${symptom.nama_gejala}</div>
                    <small style="color: #64748b;">Rata-rata CF: ${cf}</small>
                </div>
                <select class="symptom-input form-select w-50" id="${symptom.kode_gejala}">
                    <option value="0">Tidak</option>
                    <option value="0.2">Tidak Tahu</option>
                    <option value="0.4">Sedikit Yakin</option>
                    <option value="0.6">Cukup Yakin</option>
                    <option value="0.8">Yakin</option>
                    <option value="1.0">Sangat Yakin</option>
                </select>
            `;
            container.appendChild(symptomDiv);
        });
    }

    // Perform diagnosis
    function performDiagnosis() {
        // Validate patient info
        const patientName = document.getElementById('patientName').value.trim();
        const farmLocation = document.getElementById('farmLocation').value.trim();
        const farmSize = document.getElementById('farmSize').value.trim();
        // console.log(patientName, farmLocation, farmSize);

        if (!patientName || !farmLocation || !farmSize) {
            showAlert('warning', 'Mohon lengkapi informasi pasien terlebih dahulu!');
            return;
        }

        // Get user input values
        const userInputs = {};
        let hasInput = false;

        // Get unique symptom codes
        const uniqueSymptoms = {};
        symptomsData.forEach(symptom => {
            if (!uniqueSymptoms[symptom.kode_gejala]) {
                uniqueSymptoms[symptom.kode_gejala] = symptom;
            }
        });

        Object.keys(uniqueSymptoms).forEach(kodeGejala => {
            const input = document.getElementById(kodeGejala);
            if (input) {
                const value = parseFloat(input.value) || 0;
                userInputs[kodeGejala] = value;
                if (value > 0) hasInput = true;
            }
        });

        if (!hasInput) {
            showAlert('warning', 'Mohon masukkan minimal satu nilai gejala!');
            return;
        }

        // Show loading state
        const diagnosisBtn = document.getElementById('diagnosisBtn');
        const originalText = diagnosisBtn.innerHTML;
        diagnosisBtn.innerHTML = '<div class="loading-spinner"></div> Memproses...';
        diagnosisBtn.disabled = true;

        // Send diagnosis request
        fetch('<?= base_url('admin/processDiagnosis') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `nama_pasien=${encodeURIComponent(patientName)}&gejala_values=${encodeURIComponent(JSON.stringify(userInputs))}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentDiagnosisResults = data.results;
                    displayResults(data.results, {
                        patientName,
                        farmLocation,
                        farmSize
                    });
                } else {
                    showAlert('error', data.message || 'Gagal melakukan diagnosis');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan saat melakukan diagnosis');
            })
            .finally(() => {
                // Restore button state
                diagnosisBtn.innerHTML = originalText;
                diagnosisBtn.disabled = false;
            });
    }

    // Display diagnosis results
    function displayResults(results, patientInfo) {
        const resultsSection = document.getElementById('resultsSection');
        const resultsContainer = document.getElementById('diagnosisResults');

        // Sort results by percentage value
        const sortedResults = Object.entries(results)
            .sort(([, a], [, b]) => b.percentage - a.percentage);

        let html = `
            <div style="background: #f8fafc; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <h4 style="color: #1e40af; margin-bottom: 1rem;">Informasi Pasien</h4>
                <p><strong>Nama:</strong> ${patientInfo.patientName}</p>
                <p><strong>Alamat Lahan:</strong> ${patientInfo.farmLocation}</p>
                <p><strong>Luas Lahan:</strong> ${patientInfo.farmSize} Ha</p>
                <p><strong>Tanggal Diagnosis:</strong> ${new Date().toLocaleDateString('id-ID')}</p>
            </div>
        `;

        sortedResults.forEach(([code, result]) => {
            const percentage = result.percentage;
            let resultClass = 'low';
            let confidenceText = 'Kemungkinan Rendah';

            if (percentage >= 70) {
                resultClass = 'high';
                confidenceText = 'Kemungkinan Tinggi';
            } else if (percentage >= 40) {
                resultClass = 'medium';
                confidenceText = 'Kemungkinan Sedang';
            }

            html += `
                <div class="diagnosis-result ${resultClass}">
                    <div class="cf-value">${percentage.toFixed(1)}%</div>
                    <div class="disease-name">${result.name}</div>
                    <div class="confidence-level">${confidenceText}</div>
                    <small>CF Value: ${result.cf.toFixed(3)} | Gejala Cocok: ${result.matching_symptoms}/${result.total_symptoms}</small>
                    
                    ${percentage >= 40 ? `
                        <div class="recommendations">
                            <h4>Rekomendasi Penanganan:</h4>
                            <ul>
                                ${result.recommendations.map(rec => `<li>• ${rec}</li>`).join('')}
                            </ul>
                        </div>
                    ` : ''}
                </div>
            `;
        });

        resultsContainer.innerHTML = html;
        resultsSection.classList.add('show');

        // Show save and print buttons
        document.getElementById('saveBtn').style.display = 'inline-flex';
        document.getElementById('printBtn').style.display = 'inline-flex';

        // Scroll to results
        resultsSection.scrollIntoView({
            behavior: 'smooth'
        });

        showAlert('success', 'Diagnosis berhasil dilakukan!');
    }

    // Save diagnosis to database
    function saveDiagnosis() {
        if (!currentDiagnosisResults) {
            showAlert('warning', 'Tidak ada hasil diagnosis untuk disimpan');
            return;
        }

        const patientName = document.getElementById('patientName').value.trim();
        const farmLocation = document.getElementById('farmLocation').value.trim();
        const farmSize = document.getElementById('farmSize').value.trim();

        if (!patientName) {
            showAlert('warning', 'Nama pasien harus diisi');
            return;
        }

        // Show loading state
        const saveBtn = document.getElementById('saveBtn');
        const originalText = saveBtn.innerHTML;
        saveBtn.innerHTML = '<div class="loading-spinner"></div> Menyimpan...';
        saveBtn.disabled = true;

        // Send save request
        fetch('<?= base_url('admin/saveDiagnosisResult') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `nama_pasien=${encodeURIComponent(patientName)}&alamat_lahan=${encodeURIComponent(farmLocation)}&luas_lahan=${encodeURIComponent(farmSize)}&diagnosis_results=${encodeURIComponent(JSON.stringify(currentDiagnosisResults))}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', 'Hasil diagnosis berhasil disimpan!');
                    saveBtn.innerHTML = '<span>✓</span> Tersimpan';
                    saveBtn.disabled = true;
                    setTimeout(function () {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    showAlert('error', data.message || 'Gagal menyimpan hasil diagnosis');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan saat menyimpan');
            })
            .finally(() => {
                if (!saveBtn.innerHTML.includes('Tersimpan')) {
                    saveBtn.innerHTML = originalText;
                    saveBtn.disabled = false;
                }
            });
    }

    // Reset form
    function resetForm() {
        // Reset patient form
        document.getElementById('patientForm').reset();

        // Reset symptom selections
        const uniqueSymptoms = {};
        symptomsData.forEach(symptom => {
            if (!uniqueSymptoms[symptom.kode_gejala]) {
                uniqueSymptoms[symptom.kode_gejala] = symptom;
            }
        });

        Object.keys(uniqueSymptoms).forEach(kodeGejala => {
            const input = document.getElementById(kodeGejala);
            if (input) {
                input.value = '0';
            }
        });

        // Hide results and buttons
        document.getElementById('resultsSection').classList.remove('show');
        document.getElementById('saveBtn').style.display = 'none';
        document.getElementById('printBtn').style.display = 'none';

        // Reset save button state
        const saveBtn = document.getElementById('saveBtn');
        saveBtn.innerHTML = '<span>💾</span> Simpan Hasil';
        saveBtn.disabled = false;

        // Clear current results
        currentDiagnosisResults = null;

        showAlert('info', 'Form berhasil direset');
    }

    // Print results
    function printResults() {
        if (!currentDiagnosisResults) {
            showAlert('warning', 'Tidak ada hasil diagnosis untuk dicetak');
            return;
        }

        // Create print window
        const printWindow = window.open('', '', 'width=800,height=600');
        const patientName = document.getElementById('patientName').value;
        const farmLocation = document.getElementById('farmLocation').value;
        const farmSize = document.getElementById('farmSize').value;

        const printContent = generatePrintContent(currentDiagnosisResults, {
            patientName,
            farmLocation,
            farmSize
        });

        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.print();
    }

    // Generate print content
    function generatePrintContent(results, patientInfo) {
        const sortedResults = Object.entries(results)
            .sort(([, a], [, b]) => b.percentage - a.percentage);

        let resultsHtml = '';
        sortedResults.forEach(([code, result]) => {
            const percentage = result.percentage;
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
                    <p><strong>CF Value:</strong> ${result.cf.toFixed(3)}</p>
                    <p><strong>Gejala yang Cocok:</strong> ${result.matching_symptoms}/${result.total_symptoms}</p>
                    
                    ${percentage >= 40 && result.recommendations.length > 0 ? `
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
                <title>Hasil Diagnosis - ${patientInfo.patientName}</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .header { text-align: center; margin-bottom: 30px; }
                    .patient-info { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
                    h1, h2, h3 { color: #1e40af; }
                    .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #666; }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>SISTEM PAKAR DIAGNOSIS PENYAKIT UBI JALAR</h1>
                    <h2>Hasil Diagnosis</h2>
                </div>
                
                <div class="patient-info">
                    <h3>Informasi Pasien</h3>
                    <p><strong>Nama Petani:</strong> ${patientInfo.patientName}</p>
                    <p><strong>Alamat Lahan:</strong> ${patientInfo.farmLocation}</p>
                    <p><strong>Luas Lahan:</strong> ${patientInfo.farmSize} Ha</p>
                    <p><strong>Tanggal Diagnosis:</strong> ${new Date().toLocaleDateString('id-ID')}</p>
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

    // Show alert message
    function showAlert(type, message) {
        // Remove existing alerts
        const existingAlerts = document.querySelectorAll('.custom-alert');
        existingAlerts.forEach(alert => alert.remove());

        // Create alert element
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show custom-alert`;
        alert.style.position = 'fixed';
        alert.style.top = '20px';
        alert.style.right = '20px';
        alert.style.zIndex = '9999';
        alert.style.minWidth = '300px';

        const icon = type === 'success' ? 'check-circle' :
            type === 'error' || type === 'danger' ? 'exclamation-circle' :
                type === 'warning' ? 'exclamation-triangle' : 'info-circle';

        alert.innerHTML = `
            <i class="fas fa-${icon} me-2"></i>
            ${message}
            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
        `;

        document.body.appendChild(alert);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alert.parentElement) {
                alert.remove();
            }
        }, 5000);
    }

    // Handle form submission with Enter key
    document.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const activeElement = document.activeElement;

            // If user is in patient form, perform diagnosis
            if (activeElement && activeElement.closest('#patientForm')) {
                performDiagnosis();
            }
        }
    });
</script>

<?= $this->endSection(); ?>