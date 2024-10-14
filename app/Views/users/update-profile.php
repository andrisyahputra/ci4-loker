<!-- <= dd($users) ?> -->
<?= $this->extend('layouts/app.php'); ?>

<?= $this->section('content'); ?>
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image"
    style="background-image: url('<?= base_url() ?>assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Update Profile</h1>
                <div class="custom-breadcrumbs">
                    <a href="<?= base_url() ?>">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Update Profile</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <form action="<?= url_to('submit.update.profile') ?>" method="POST" class="p-4 border rounded">

                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="nama">Nama</label>
                            <input name="nama" type="text" id="nama" class="form-control" placeholder="Masukkan Nama"
                                value="<?= $users->nama ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="type">Posisi</label>
                            <input name="type" type="text" id="type" class="form-control"
                                placeholder="Masukkan Posisi Anda" value="<?= $users->type ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="email">Masukkan Email</label>
                            <input name="email" type="email" id="email" class="form-control"
                                placeholder="Masukkan Email" value="<?= $users->email ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="fb">Facebook</label>
                            <input name="fb" type="text" id="fb" class="form-control" placeholder="Masukkan FB"
                                value="<?= $users->fb ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="twitter">Twitter</label>
                            <input name="twitter" type="text" id="twitter" class="form-control"
                                placeholder="Masukkan Twitter" value="<?= $users->twitter ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="linked">Linked</label>
                            <input name="linked" type="text" id="linked" class="form-control"
                                placeholder="Masukkan Linked" value="<?= $users->linked ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="ig">Instagram</label>
                            <input name="ig" type="text" id="ig" class="form-control" placeholder="Masukkan Instagram"
                                value="<?= $users->ig ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="exampleFormControlTextarea1">Bio</label>
                            <textarea name="bio" class="form-control" id="exampleFormControlTextarea1" rows="3">
                                <?= $users->bio ?>
                            </textarea>
                        </div>
                    </div>



                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" value="Simpan" class="btn px-4 btn-primary text-white">
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>