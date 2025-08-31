<?= $this->extend('layouts/admin.php'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white border-0">
                    <div>
                        <div>
                            <h4 class="mb-0 ">
                                <i class="fa fa-stethoscope me-2"></i><?= $judul ?>
                            </h4>
                            <small class="text-dark">Kelola data gejala penyakit tanaman ubi jalar</small>
                            <br>
                            <a href="<?= url_to('gejala.tambah') ?>" class="btn mt-2 mb-2 btn-primary btn-sm">
                                <i class="fa fa-plus me-1"></i>Tambah Gejala
                            </a>
                        </div>

                    </div>
                </div>

                <div class="card-body p-0">
                    <!-- Added modern alert styling -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show m-3 mb-0" role="alert">
                            <i class="fa fa-check-circle me-2"></i>
                            <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show m-3 mb-0" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>
                            <strong>Gagal!</strong> <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- <div class="table-responsive">
                        <table class="table table-hover mb-0" id="gejalaTable"> -->
                    <div class="dt-ext table-responsive theme-scrollbar">
                        <table class="display" id="export-button">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">#</th>
                                    <th width="10%">Kode</th>
                                    <th width="15%">Kode Penyakit</th>
                                    <th width="15%">Nama Penyakit</th>
                                    <th width="35%">Nama Gejala</th>
                                    <th class="text-center" width="10%">MB</th>
                                    <th class="text-center" width="10%">MD</th>
                                    <th class="text-center" width="10%">CF</th>
                                    <th class="text-center" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($gejala)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="fa fa-inbox fa-2x mb-2 d-block"></i>
                                            Belum ada data gejala
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($gejala as $key => $item): ?>
                                        <tr>
                                            <td class="text-center fw-bold"><?= ++$key ?></td>
                                            <td>
                                                <span class="badge bg-primary"><?= $item['kode_gejala'] ?></span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info"><?= $item['kode_penyakit'] ?></span>
                                            </td>
                                            <td>
                                                <?= $item['nama_penyakit'] ?>
                                            </td>
                                            <td><?= $item['nama_gejala'] ?></td>

                                            <td class="text-center">
                                                <span class="badge bg-success"><?= number_format($item['mb'], 2) ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-warning"><?= number_format($item['md'], 2) ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge <?= $item['cf'] >= 0 ? 'bg-info' : 'bg-secondary' ?>">
                                                    <?= number_format($item['cf'], 2) ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="<?= url_to('gejala.edit', $item['kode_gejala']) ?>"
                                                        class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?= url_to('gejala.hapus', $item['kode_gejala']) ?>"
                                                        class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                                        title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus gejala ini?')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Initialize DataTable if available
        if (typeof $('#gejalaTable').DataTable === 'function') {
            $('#gejalaTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                }
            });
        }
    });
</script>
<?= $this->endSection(); ?>