<?= $this->extend('layouts/admin.php'); ?>

<?= $this->section('content'); ?>
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <!-- <div class="d-flex justify-content-between "> -->
            <h4><?= $judul ?></h4>
            <a href="<?= url_to('admin.tambah') ?>" class="btn btn-success-gradien my-3" type="button">Tambah
                Admin</a>
            <!-- </div> -->

        </div>
        <div class="card-body">
            <div class="dt-ext table-responsive theme-scrollbar">
                <table class="display" id="export-button">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>email</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allAdmins as $key => $value): ?>


                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td><?= $value['email'] ?></td>
                                <td> <img class="img-fluid table-avtar"
                                        src="<?= base_url() ?>admin/assets/images/user/1.jpg" alt="profile">
                                </td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>
                                    <ul class="action">
                                        <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                        <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
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