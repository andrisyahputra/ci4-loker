<?= $this->extend('layouts/app.php'); ?>

<?= $this->section('content'); ?>

<section class="section-hero overlay inner-page bg-image"
    style="background-image: url('<?= base_url() ?>assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <strong>Success!</strong>
            <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <strong>Gagal!</strong>
            <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif ?>
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-3 py-4">

                    <div class="text-center">
                        <img src="<?= base_url() ?>assets/images/<?= auth()->user()->foto ?>" width="100"
                            class="rounded-circle">
                    </div>


                    <div class="text-center mt-3">
                        <!-- <span class="bg-secondary p-1 px-4 rounded text-white">Pro</span> -->
                        <h5 class="mt-2 mb-0"><?= auth()->user()->nama ?></h5>
                        <span><?= auth()->user()->type ?></span>

                        <div class="text-center">
                            <a class="btn btn-success text-white"
                                href="<?= base_url('public/assets/cvs/' . auth()->user()->cv) ?>">My CV</a>
                        </div>

                        <div class="px-4 mt-1">
                            <p class="fonts"><?= auth()->user()->bio ?></p>

                        </div>



                        <div class="px-3">
                            <a href="<?= auth()->user()->fb ?>" class="pt-3 pb-3 pr-3 pl-0 underline-none"><span
                                    class="icon-facebook"></span></a>
                            <a href="<?= auth()->user()->twitter ?>" class="pt-3 pb-3 pr-3 pl-0"><span
                                    class="icon-twitter"></span></a>
                            <a href="<?= auth()->user()->linked ?>" class="pt-3 pb-3 pr-3 pl-0"><span
                                    class="icon-linkedin"></span></a>
                        </div>



                    </div>




                </div>
            </div>
        </div>


    </div>
</section>
<?= $this->endSection(); ?>