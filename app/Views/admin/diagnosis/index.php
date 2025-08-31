<?= $this->extend('layouts/admin.php'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fa fa-list-alt me-2"></i>
                            <?= $judul ?>
                        </h4>
                        <div class="btn-group">
                            <a href="<?= url_to('admin.diagnosis') ?>" class="btn btn-light btn-sm">
                                <i class="fa fa-plus me-1"></i>
                                Diagnosis Baru
                            </a>
                            <button type="button" class="btn btn-light btn-sm" onclick="exportData()">
                                <i class="fa fa-download me-1"></i>
                                Export
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Statistics Cards -->
                    <?php if (isset($stats)): ?>
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-0"><?= $stats['total'] ?></h5>
                                                <p class="mb-0">Total Diagnosis</p>
                                            </div>
                                            <i class="fa fa-chart-line fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-0"><?= count($stats['by_disease']) ?></h5>
                                                <p class="mb-0">Jenis Penyakit</p>
                                            </div>
                                            <i class="fa fa-bug fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-0"><?= date('M Y') ?></h5>
                                                <p class="mb-0">Periode Terakhir</p>
                                            </div>
                                            <i class="fa fa-calendar fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="mb-0">
                                                    <?= isset($stats['monthly'][0]) ? $stats['monthly'][0]['count'] : 0 ?>
                                                </h5>
                                                <p class="mb-0">Bulan Ini</p>
                                            </div>
                                            <i class="fa fa-chart-bar fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Search and Filter -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchKeyword"
                                    placeholder="Cari nama pasien, alamat, atau penyakit..."
                                    value="<?= $search_params['keyword'] ?? '' ?>">
                                <button class="btn btn-primary" onclick="searchDiagnosis()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="dateFrom" placeholder="Dari Tanggal"
                                value="<?= $search_params['date_from'] ?? '' ?>">
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="dateTo" placeholder="Sampai Tanggal"
                                value="<?= $search_params['date_to'] ?? '' ?>">
                        </div>
                    </div>

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

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="diagnosisTable">
                            <thead class="table-primary">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Nama Pasien</th>
                                    <th width="20%">Alamat Lahan</th>
                                    <th width="10%">Luas Lahan</th>
                                    <th width="15%">Penyakit Terdiagnosis</th>
                                    <th width="10%">Nilai CF</th>
                                    <th width="15%">Tanggal Diagnosis</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($diagnosis)): ?>
                                    <?php foreach ($diagnosis as $index => $item): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <strong><?= esc($item['nama_pasien']) ?></strong>
                                            </td>
                                            <td><?= esc($item['alamat_lahan']) ?></td>
                                            <td><?= esc($item['luas_lahan']) ?> Ha</td>
                                            <td>
                                                <?php if ($item['nama_penyakit']): ?>
                                                    <span class="badge bg-primary">
                                                        <?= esc($item['nama_penyakit']) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Tidak Terdeteksi</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($item['nilai_cf_tertinggi']): ?>
                                                    <span
                                                        class="badge bg-<?= $item['nilai_cf_tertinggi'] >= 0.7 ? 'success' : ($item['nilai_cf_tertinggi'] >= 0.4 ? 'warning' : 'secondary') ?>">
                                                        <?= number_format($item['nilai_cf_tertinggi'] * 100, 1) ?>%
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small><?= date('d/m/Y H:i', strtotime($item['tanggal_diagnosis'])) ?></small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-info"
                                                        onclick="viewDetail(<?= $item['id'] ?>)" title="Lihat Detail">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning"
                                                        onclick="printDiagnosis(<?= $item['id'] ?>)" title="Cetak">
                                                        <i class="fa fa-print"></i>
                                                    </button>
                                                    <a href="<?= url_to('diagnosis.edit', $item['id']) ?>"
                                                        class="btn btn-primary" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="deleteDiagnosis(<?= $item['id'] ?>, '<?= esc($item['nama_pasien']) ?>')"
                                                        title="Hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <i class="fa fa-search fa-3x text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Tidak ada data diagnosis ditemukan</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Diagnosis -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Hasil Diagnosis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalDetailContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="printModalContent()">Cetak</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Search diagnosis
    function searchDiagnosis() {
        const keyword = document.getElementById('searchKeyword').value;
        const dateFrom = document.getElementById('dateFrom').value;
        const dateTo = document.getElementById('dateTo').value;

        let url = '<?= url_to('diagnosis.search') ?>?';
        const params = [];

        if (keyword) params.push(`keyword=${encodeURIComponent(keyword)}`);
        if (dateFrom) params.push(`date_from=${dateFrom}`);
        if (dateTo) params.push(`date_to=${dateTo}`);

        url += params.join('&');
        window.location.href = url;
    }

    // View diagnosis detail
    function viewDetail(id) {
        fetch(`<?= base_url('admin/diagnosisDetail') ?>/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayDetailModal(data.data);
                } else {
                    alert('Gagal memuat detail: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat detail');
            });
    }

    // Display detail in modal
    function displayDetailModal(data) {
        const results = typeof data.hasil_diagnosis === 'string' ?
            JSON.parse(data.hasil_diagnosis) :
            data.hasil_diagnosis;

        let html = `
            <div class="mb-3">
                <h6>Informasi Pasien</h6>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama:</strong> ${data.nama_pasien}</p>
                        <p><strong>Alamat Lahan:</strong> ${data.alamat_lahan || '-'}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Luas Lahan:</strong> ${data.luas_lahan || '-'} Ha</p>
                        <p><strong>Tanggal:</strong> ${new Date(data.tanggal_diagnosis).toLocaleString('id-ID')}</p>
                    </div>
                </div>
            </div>
            
            <h6>Hasil Diagnosis</h6>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Penyakit</th>
                            <th>Persentase</th>
                            <th>CF Value</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        // Sort results by percentage
        const sortedResults = Object.entries(results)
            .sort(([, a], [, b]) => b.percentage - a.percentage);

        sortedResults.forEach(([code, result]) => {
            const percentage = result.percentage || 0;
            let statusClass = 'secondary';
            let statusText = 'Rendah';

            if (percentage >= 70) {
                statusClass = 'success';
                statusText = 'Tinggi';
            } else if (percentage >= 40) {
                statusClass = 'warning';
                statusText = 'Sedang';
            }

            html += `
                <tr>
                    <td>${result.name}</td>
                    <td>${percentage.toFixed(1)}%</td>
                    <td>${(result.cf || 0).toFixed(3)}</td>
                    <td><span class="badge bg-${statusClass}">${statusText}</span></td>
                </tr>
            `;
        });

        html += `
                    </tbody>
                </table>
            </div>
        `;

        // Add recommendations for high probability diseases
        const highProbResults = sortedResults.filter(([, result]) => result.percentage >= 40);
        if (highProbResults.length > 0) {
            html += '<h6 class="mt-3">Rekomendasi Penanganan</h6>';
            highProbResults.forEach(([code, result]) => {
                if (result.recommendations && result.recommendations.length > 0) {
                    html += `
                        <div class="mb-3">
                            <strong>${result.name}:</strong>
                            <ul class="mt-2">
                                ${result.recommendations.map(rec => `<li>${rec}</li>`).join('')}
                            </ul>
                        </div>
                    `;
                }
            });
        }

        document.getElementById('modalDetailContent').innerHTML = html;
        new bootstrap.Modal(document.getElementById('detailModal')).show();
    }

    // Delete diagnosis
    function deleteDiagnosis(id, name) {
        if (confirm(`Apakah Anda yakin ingin menghapus diagnosis untuk ${name}?`)) {
            window.location.href = `<?= base_url('admin/hapus-diagnosis') ?>/${id}`;
        }
    }

    // Print diagnosis
    function printDiagnosis(id) {
        fetch(`<?= base_url('admin/diagnosisDetail') ?>/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    printDiagnosisData(data.data);
                } else {
                    alert('Gagal memuat data untuk cetak');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data');
            });
    }

    // Print diagnosis data
    function printDiagnosisData(data) {
        const results = typeof data.hasil_diagnosis === 'string' ?
            JSON.parse(data.hasil_diagnosis) :
            data.hasil_diagnosis;

        const printWindow = window.open('', '', 'width=800,height=600');

        // Sort results by percentage
        const sortedResults = Object.entries(results)
            .sort(([, a], [, b]) => b.percentage - a.percentage);

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
                    <p><strong>Gejala yang Cocok:</strong> ${result.matching_symptoms || '-'}/${result.total_symptoms || '-'}</p>
                    
                    ${percentage >= 40 && result.recommendations && result.recommendations.length > 0 ? `
                        <h4>Rekomendasi Penanganan:</h4>
                        <ul>
                            ${result.recommendations.map(rec => `<li>${rec}</li>`).join('')}
                        </ul>
                    ` : ''}
                </div>
            `;
        });

        const printContent = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Hasil Diagnosis - ${data.nama_pasien}</title>
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
                    <h2>Hasil Diagnosis</h2>
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

        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.print();
    }

    // Print modal content
    function printModalContent() {
        const modalContent = document.getElementById('modalDetailContent').innerHTML;
        const printWindow = window.open('', '', 'width=800,height=600');

        const printContent = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Detail Diagnosis</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .header { text-align: center; margin-bottom: 30px; }
                    h1, h2, h3, h6 { color: #1e40af; }
                    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f8f9fa; }
                    .badge { padding: 2px 6px; border-radius: 3px; font-size: 12px; }
                    .bg-success { background-color: #28a745; color: white; }
                    .bg-warning { background-color: #ffc107; color: black; }
                    .bg-secondary { background-color: #6c757d; color: white; }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>SISTEM PAKAR DIAGNOSIS PENYAKIT UBI JALAR</h1>
                    <h2>Detail Hasil Diagnosis</h2>
                </div>
                
                ${modalContent}
                
                <div style="margin-top: 30px; text-align: center; font-size: 12px; color: #666;">
                    <p>Dicetak pada: ${new Date().toLocaleString('id-ID')}</p>
                </div>
            </body>
            </html>
        `;

        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.print();
    }

    // Export data
    function exportData() {
        // Simple CSV export
        const table = document.getElementById('diagnosisTable');
        const rows = table.querySelectorAll('tr');
        let csv = [];

        for (let i = 0; i < rows.length; i++) {
            const row = [],
                cols = rows[i].querySelectorAll('td, th');

            for (let j = 0; j < cols.length - 1; j++) { // Exclude action column
                let cellText = cols[j].innerText.replace(/"/g, '""');
                row.push('"' + cellText + '"');
            }

            csv.push(row.join(','));
        }

        // Download CSV
        const csvFile = new Blob([csv.join('\n')], {
            type: 'text/csv'
        });
        const downloadLink = document.createElement('a');
        downloadLink.download = `diagnosis_${new Date().toISOString().split('T')[0]}.csv`;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = 'none';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }

    // Enhanced search with Enter key
    document.getElementById('searchKeyword').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            searchDiagnosis();
        }
    });

    document.getElementById('dateFrom').addEventListener('change', searchDiagnosis);
    document.getElementById('dateTo').addEventListener('change', searchDiagnosis);

    // Auto-refresh every 5 minutes
    setInterval(function () {
        location.reload();
    }, 300000);
</script>

<?= $this->endSection(); ?>