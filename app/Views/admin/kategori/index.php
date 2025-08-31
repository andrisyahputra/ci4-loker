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
            <a href="<?= url_to('kategori.tambah') ?>" class="btn btn-success-gradien my-3" type="button">Tambah
                Admin</a>
            <!-- </div> -->

        </div>
        <div class="card-body">
            <div class="dt-ext table-responsive theme-scrollbar">
                <table class="display" id="export-button">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <!-- <th>email</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model as $key => $value): ?>


                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $value['nama'] ?></td>
                                <!-- <td><= $value['email'] ?></td>
                                <td> <img class="img-fluid table-avtar"
                                        src="<= base_url() ?>admin/assets/images/user/1.jpg" alt="profile">
                                </td>
                                <td>2011/04/25</td>
                                <td>$320,800</td> -->
                                <td>
                                    <ul class="action">
                                        <li class="edit"> <a href="<?= url_to('kategori.edit', $value['id']) ?>"><i
                                                    class="icon-pencil-alt"></i></a></li>
                                        <li class="delete"><a href="<?= url_to('kategori.hapus', $value['id']) ?>"><i
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