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
                        <p class="mb-0 fs-5">Dinas Ketahanan Pangan dan Pertanian Kota Binjai</p>
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

<div class="row">
    <!-- Updated dashboard cards for diagnosis system statistics -->
    <div class="col-xl-3 col-xl-40 col-md-6 proorder-md-1">
        <div class="card">
            <div class="card-header card-no-border pb-0">
                <div class="header-top">
                    <h4>Statistik Sistem Diagnosis</h4>
                    <div class="dropdown icon-dropdown">
                        <button class="btn dropdown-toggle" id="userdropdown" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="icon-more-alt"></i></button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown">
                            <a class="dropdown-item" href="#">Mingguan</a>
                            <a class="dropdown-item" href="#">Bulanan</a>
                            <a class="dropdown-item" href="#">Tahunan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body project-status-col">
                <div class="row">
                    <div class="col-6">
                        <div class="btn-light1-primary b-r-10">
                            <div class="upcoming-box">
                                <div class="upcoming-icon bg-primary">
                                    <i class="fa fa-users" style="font-size: 24px; color: white;"></i>
                                </div>
                                <h6>Total Pengguna</h6>
                                <p><?= $user ?? 0 ?> Pengguna</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="btn-light1-secondary b-r-10">
                            <div class="upcoming-box">
                                <div class="upcoming-icon bg-secondary">
                                    <i class="fa fa-stethoscope" style="font-size: 24px; color: white;"></i>
                                </div>
                                <h6>Total Diagnosis</h6>
                                <p><?= $diagnosis ?? 0 ?> Diagnosis</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="btn-light1-warning b-r-10">
                            <div class="upcoming-box mb-0">
                                <div class="upcoming-icon bg-warning">
                                    <i class="fa fa-bug" style="font-size: 24px; color: white;"></i>
                                </div>
                                <h6>Total Penyakit</h6>
                                <p><?= $penyakit ?? 3 ?> Penyakit</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="btn-light1-tertiary b-r-10">
                            <div class="upcoming-box mb-0">
                                <div class="upcoming-icon bg-tertiary">
                                    <i class="fa fa-list-alt" style="font-size: 24px; color: white;"></i>
                                </div>
                                <h6>Total Gejala</h6>
                                <p><?= $gejala ?? 15 ?> Gejala</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Added disease frequency chart -->
    <div class="col-xl-6 col-md-6">
        <div class="card">
            <div class="card-header card-no-border pb-0">
                <div class="header-top">
                    <h4>Penyakit Paling Sering Didiagnosis</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="diseaseChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Added recent diagnosis table -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-header card-no-border pb-0">
                <div class="header-top">
                    <h4>Diagnosis Terbaru</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="recent-diagnosis">
                    <?php if (isset($recentDiagnosis) && !empty($recentDiagnosis)): ?>
                    <?php foreach ($recentDiagnosis as $diagnosis): ?>
                    <div class="diagnosis-item mb-3 p-2 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1"><?= $diagnosis['nama_pasien'] ?></h6>
                                <small class="text-muted"><?= $diagnosis['penyakit_terdiagnosis'] ?></small>
                            </div>
                            <div class="text-end">
                                <span
                                    class="badge bg-primary"><?= number_format($diagnosis['nilai_cf_tertinggi'] * 100, 1) ?>%</span>
                                <br>
                                <small
                                    class="text-muted"><?= date('d/m/Y', strtotime($diagnosis['tanggal_diagnosis'])) ?></small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="text-muted text-center">Belum ada diagnosis</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Added monthly diagnosis trend chart -->
<!-- <div class="row mt-4">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header card-no-border pb-0">
                <div class="header-top">
                    <h4>Tren Diagnosis Bulanan</h4>
                </div>
            </div>
            <div class="card-body">
                <canvas id="monthlyTrendChart" width="400" height="150"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card">
            <div class="card-header card-no-border pb-0">
                <div class="header-top">
                    <h4>Tingkat Akurasi Diagnosis</h4>
                </div>
            </div>
            <div class="card-body text-center">
                <div class="accuracy-circle mb-3">
                    <canvas id="accuracyChart" width="150" height="150"></canvas>
                </div>
                <h5 class="text-primary"><?= $accuracyRate ?? '85.2' ?>%</h5>
                <p class="text-muted">Tingkat Kepercayaan Rata-rata</p>
            </div>
        </div>
    </div>
</div> -->

<!-- Added Chart.js for visualizations -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Disease frequency chart
// const diseaseData = <= json_encode($diseaseFrequency ?? [
//         ['Busuk Umbi', 45],
//         ['Hawar Daun', 32],
//         ['Kudis (Scab)', 23]
//     ]) ?>;

// const ctx1 = document.getElementById('diseaseChart').getContext('2d');
// new Chart(ctx1, {
//     type: 'doughnut',
//     data: {
//         labels: diseaseData.map(item => item[0]),
//         datasets: [{
//             data: diseaseData.map(item => item[1]),
//             backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
//             borderWidth: 2,
//             borderColor: '#fff'
//         }]
//     },
//     options: {
//         responsive: true,
//         plugins: {
//             legend: {
//                 position: 'bottom'
//             }
//         }
//     }
// });
const diseaseData = <?= json_encode($diseaseFrequency) ?>;

const ctx1 = document.getElementById('diseaseChart').getContext('2d');
new Chart(ctx1, {
    type: 'doughnut',
    data: {
        labels: diseaseData.map(item => item[0]),
        datasets: [{
            data: diseaseData.map(item => item[1]),
            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: ctx => `${ctx.label}: ${ctx.raw}`
                }
            }
        }
    }
});

// Monthly trend chart
const monthlyData = <?= json_encode($monthlyTrend ?? [
        ['Jan', 12],
        ['Feb', 19],
        ['Mar', 15],
        ['Apr', 22],
        ['May', 18],
        ['Jun', 25]
    ]) ?>;

const ctx2 = document.getElementById('monthlyTrendChart').getContext('2d');
new Chart(ctx2, {
    type: 'line',
    data: {
        labels: monthlyData.map(item => item[0]),
        datasets: [{
            label: 'Jumlah Diagnosis',
            data: monthlyData.map(item => item[1]),
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Accuracy chart
const ctx3 = document.getElementById('accuracyChart').getContext('2d');
new Chart(ctx3, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [<?= $accuracyRate ?? 85.2 ?>, <?= 100 - ($accuracyRate ?? 85.2) ?>],
            backgroundColor: ['#10b981', '#e5e7eb'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        cutout: '70%',
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>

<?= $this->endSection(); ?>