<?= $this->extend('layouts/admin.php'); ?>

<?= $this->section('content'); ?>

<div class="col-xl-12 xl-60 box-col-12">
    <div class="card">
        <div class="job-search">
            <div class="card-body pb-0">
                <div class="d-flex"><img class="img-40 img-fluid m-r-20"
                        src="<?= base_url() ?>admin/assets/images/job-search/1.jpg" alt="">
                    <div class="flex-grow-1">
                        <h6 class="f-w-600"><a href="#">UI Designer</a><span class="pull-right">
                                <button class="btn btn-primary" type="button"><span><i
                                            class="fa fa-check text-white"></i></span> Save this job</button></span>
                        </h6>
                        <p>Endless Telecom & Technologies , NY<span><i class="fa fa-star font-warning"></i><i
                                    class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i
                                    class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i></span>
                        </p>
                    </div>
                </div>
                <div class="job-description">
                    <h4 class="mb-0"><?= $judul ?> </h4>
                    <form class="form theme-form" method="POST" action="<?= url_to('kategori.store') ?>">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput1">Nama:<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" id="exampleFormControlInput1" name="nama"
                                        placeholder="Masukkan Nama Kategori" required>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
                <input class="btn btn-light" type="reset" value="Cancel">
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>