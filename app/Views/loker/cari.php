<!-- <= dd($search); ?> -->
<?= $this->extend('layouts/app.php'); ?>

<?= $this->section('content'); ?>
<section class="section-hero overlay inner-page bg-image"
    style="background-image: url('<?= base_url() ?>assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Pencarian Loker</h1>
                <div class="custom-breadcrumbs">
                    <a href="<?= base_url() ?>">Home</a> <span class="mx-2 slash">/</span>
                    <a href="#">Loker</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Pencarian Loker</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section">
    <div class="container">

        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="section-title mb-2"><?= $totalLoker ?> Loker Dicari <?= $cari ?></h2>
            </div>
        </div>

        <ul class="job-listings mb-5">
            <?php if (empty($search)): ?>
                <div class="text-center">
                    <span class="badge badge-danger">Tidak Ditemukan</span>
                </div>
            <?php else: ?>
                <?php foreach ($search as $loker): ?>
                    <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                        <a href="<?= url_to('loker.detail', $loker['id']) ?>"></a>
                        <div class="job-listing-logo">
                            <img src="<?= base_url() ?>assets/images/<?= $loker['logo_perusahaan'] ?>"
                                alt="Free Website Template by Free-Template.co" class="img-fluid">
                        </div>

                        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                                <h2><?= $loker['judul'] ?></h2>
                                <strong><?= $loker['nama_perusahaan'] ?></strong>
                            </div>
                            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                                <span class="icon-room"></span> <?= $loker['lokasi'] ?>
                            </div>
                            <div class="job-listing-meta">
                                <span class="badge badge-danger"><?= $loker['type'] ?></span>
                            </div>
                        </div>

                    </li>
                <?php endforeach; ?>
            <?php endif; ?>




        </ul>



    </div>
</section>
<?= $this->endSection(); ?>