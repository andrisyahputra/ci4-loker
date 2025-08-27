<?= $this->extend('layouts/admin.php'); ?>

<?= $this->section('content'); ?>
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-light-success my-2" role="alert">
                <div class="txt-success"><strong>Berhasil</strong> <?= session()->getFlashdata('success') ?></div>
            </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-light-danger my-2" role="alert">
                <div class="txt-danger"><strong>Gagal</strong> <?= session()->getFlashdata('error') ?></div>
            </div>
            <?php endif; ?>
            <!-- <div class="d-flex justify-content-between "> -->
            <h4><?= $judul ?></h4>
            <a href="<?= url_to('loker.tambah') ?>" class="btn btn-success-gradien my-3" type="button">Tambah</a>
            <!-- </div> -->

        </div>
        <div class="card-body">
            <div class="dt-ext table-responsive theme-scrollbar">
                <table class="display" id="export-button">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CV</th>
                            <th>loker</th>
                            <th>perusahaan</th>
                            <th>lokasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model as $key => $value): ?>


                        <tr>
                            <td><?= ++$key ?></td>
                            <td><a class="btn btn-primary text-center"
                                    href="<?= base_url('public/assets/cvs/' . $value['cv']) ?>">CV</a></td>
                            <td><?= $value['judul'] ?></td>
                            <td><?= $value['nama_perusahaan'] ?></td>
                            <td><?= $value['lokasi'] ?></td>
                            <td>
                                <ul class="action">
                                    <!-- <li class="edit"> <a href="<= url_to('loker.edit', $value['id']) ?>"><i
                                                class="icon-pencil-alt"></i></a></li> -->
                                    <li class="delete"><a
                                            href="<?= url_to('loker.apply.hapus', $value['id_apply']) ?>"><i
                                                class="icon-trash"></i></a></li>
                                </ul>
                            </td>
                        </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>