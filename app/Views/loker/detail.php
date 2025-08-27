<?= $this->extend('layouts/app.php'); ?>

<?= $this->section('content'); ?>
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image"
    style="background-image: url('<?= base_url() ?>assets/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold"><?= $model['judul'] ?></h1>
                <div class="custom-breadcrumbs">
                    <a href="<?= base_url() ?>">Home</a> <span class="mx-2 slash">/</span>
                    <a href="#">Job</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Product Designer</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="site-section">
    <div class="container">
        <div class="row align-items-center mb-5">

            <div class="col-lg-8 mb-4 mb-lg-0">
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
                <div class="d-flex align-items-center">
                    <div class="border p-2 d-inline-block mr-3 rounded">
                        <img src="<?= base_url() ?>assets/images/<?= $model['logo_perusahaan'] ?>" alt="Image">
                    </div>
                    <div>
                        <h2><?= $model['judul'] ?></h2>
                        <div>
                            <span class="ml-0 mr-2 mb-2"><span
                                    class="icon-briefcase mr-2"></span><?= $model['logo_perusahaan'] ?></span>
                            <span class="m-2"><span class="icon-room mr-2"></span><?= $model['lokasi'] ?></span>
                            <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary"
                                    <?= $model['type'] ?></span></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">

                        <figure class="mb-5"><img src="<?= base_url() ?>assets/images/<?= $model['gambar'] ?>"
                                alt="Image" class="img-fluid rounded"></figure>
                        <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                class="icon-align-left mr-3"></span>Job Description</h3>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis illum fuga eveniet.
                            Deleniti asperiores, commodi quae ipsum quas est itaque, ipsa, dolore beatae voluptates nemo
                            blanditiis iste eius officia minus.</p>
                        <p>Velit unde aliquam et voluptas reiciendis non sapiente labore, deleniti asperiores blanditiis
                            nihil quia officiis dolor vero iste dolore vel molestiae saepe. Id nisi, consequuntur sunt
                            impedit quidem, vitae mollitia!</p> -->
                        <?= $model['deskripsi'] ?>
                    </div>
                    <div class="mb-5">
                        <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                class="icon-rocket mr-3"></span>Responsibilities</h3>
                        <ul class="list-unstyled m-0 p-0">
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span><?= $model['tanggung_jawab'] ?></span>
                            </li>
                            <!-- <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Velit unde aliquam et
                                    voluptas reiciendis n Velit unde aliquam et voluptas reiciendis non sapiente
                                    labore</span></li>
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Commodi quae ipsum quas est
                                    itaque</span></li>
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit</span></li>
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Deleniti asperiores
                                    blanditiis nihil quia officiis dolor</span></li> -->
                        </ul>
                    </div>

                    <div class="mb-5">
                        <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                class="icon-book mr-3"></span>Education + Experience</h3>
                        <ul class="list-unstyled m-0 p-0">
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span><?= $model['pendidikan_terakhir'] ?>
                                </span></li>
                            <!-- <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Velit unde aliquam et
                                    voluptas reiciendis non sapiente labore</span></li>
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Commodi quae ipsum quas est
                                    itaque</span></li>
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit</span></li>
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Deleniti asperiores
                                    blanditiis nihil quia officiis dolor</span></li> -->
                        </ul>
                    </div>

                    <div class="mb-5">
                        <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                class="icon-turned_in mr-3"></span>Other Benifits</h3>
                        <ul class="list-unstyled m-0 p-0">
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span><?= $model['manfaat_lainnya'] ?>
                                </span></li>
                            <!-- <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Velit unde aliquam et
                                    voluptas reiciendis non sapiente labore</span></li>
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Commodi quae ipsum quas est
                                    itaque</span></li>
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit</span></li>
                            <li class="d-flex align-items-start mb-2"><span
                                    class="icon-check_circle mr-2 text-muted"></span><span>Deleniti asperiores
                                    blanditiis nihil quia officiis dolor</span></li> -->
                        </ul>
                    </div>

                    <div class="row mb-5">
                        <div class="col-6">
                            <?php if (!isset(auth()->user()->id)): ?>
                            <button type="submit" class="btn btn-block btn-light btn-md"><i class="icon-heart"></i>Login
                                untuk Save
                                Loker</button>
                            <?php else: ?>
                            <?php if ($cekLoker > 0): ?>
                            <button disabled class="btn btn-block btn-light btn-md"><i class="icon-heart"
                                    style="color: red;"></i>Loker
                                Tersimpan</button>
                            <?php else: ?>
                            <form action="<?= url_to('save.loker', $model['id']) ?>" method="POST">
                                <input type="hidden" name="id" value="<?= $model['id'] ?>">
                                <button type="submit" class="btn btn-block btn-light btn-md"><i
                                        class="icon-heart"></i>Save
                                    Job</button>
                            </form>
                            <?php endif ?>
                            <?php endif ?>
                            <!--add text-danger to it to make it read-->
                        </div>
                        <div class="col-6">
                            <?php if (!isset(auth()->user()->id)): ?>
                            <button type="submit" class="btn btn-block btn-primary btn-md">Login untuk Apply
                                Now</button>
                            <?php else: ?>
                            <?php if ($cekApplyLoker > 0): ?>
                            <button disabled class="btn btn-block btn-primary btn-md">Loker Terkirim</button>
                            <?php else: ?>
                            <form action="<?= url_to('apply.loker', $model['id']) ?>" method="POST">
                                <input type="hidden" name="id" value="<?= $model['id'] ?>">
                                <input type="hidden" name="cv" value="<?= auth()->user()->cv ?>">
                                <input type="hidden" name="email" value="<?= auth()->user()->email ?>">
                                <button type="submit" class="btn btn-block btn-primary btn-md">Apply Now</button>
                            </form>
                            <?php endif ?>
                            <?php endif ?>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="bg-light p-3 border rounded mb-4">
                        <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
                        <ul class="list-unstyled pl-3 mb-0">
                            <li class="mb-2"><strong class="text-black">Published on:</strong> <?= $model['publish'] ?>
                            </li>
                            <li class="mb-2"><strong class="text-black">Vacancy:</strong> <?= $model['slot'] ?></li>
                            <li class="mb-2"><strong class="text-black">Employment Status:</strong>
                                <?= $model['type'] ?></li>
                            <li class="mb-2"><strong class="text-black">Experience:</strong>
                                <?= $model['lama_pengalaman'] ?></li>
                            <li class="mb-2"><strong class="text-black">Job Location:</strong> <?= $model['lokasi'] ?>
                            </li>
                            <li class="mb-2"><strong class="text-black">Salary:</strong> <?= $model['gaji'] ?></li>
                            <li class="mb-2"><strong class="text-black">Gender:</strong> <?= $model['jk'] ?></li>
                            <li class="mb-2"><strong class="text-black">Application Deadline:</strong>
                                <?= $model['batas_waktu'] ?>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-light p-3 border rounded">
                        <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
                        <div class="px-3">
                            <a target="_blank"
                                href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(url_to('loker.detail', $model['id'])) ?>&quote=<?= urlencode($model['judul']) ?>"
                                class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                            <a target="_blank"
                                href="https://twitter.com/intent/tweet?text=<?= $model['judul'] ?>&url=<?= url_to('loker.detail', $model['id']) ?>"
                                class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                            <a target="_blank"
                                href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(url_to('loker.detail', $model['id'])) ?>"
                                class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                        </div>
                    </div>

                    <!-- kategori -->
                    <div class="bg-light p-3 border rounded mb-4 mt-4">
                        <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Kategori Loker</h3>
                        <ul class="list-unstyled pl-3 mb-0">
                            <?php foreach ($allKategori as $kategori): ?>
                            <a href="<?= url_to('loker.kategori', $kategori['id']) ?>">
                                <li class="mb-2"><strong class="text-black"></strong> <?= $kategori['nama'] ?>
                                </li>
                            </a>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
</section>

<section class="site-section" id="next">
    <div class="container">

        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">

                <h2 class="section-title mb-2"><?= $totalLoker ?> Related Jobs</h2>
            </div>
        </div>

        <ul class="job-listings mb-5">
            <?php foreach ($relatedLoker as $loker): ?>
            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                <a href="<?= url_to('loker.detail', $loker->id) ?>"></a>
                <div class="job-listing-logo">
                    <img src="<?= base_url() ?>assets/images/<?= $loker->logo_perusahaan ?>"
                        alt="Free Website Template by Free-Template.co" class="img-fluid">
                </div>

                <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                    <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                        <h2><?= $loker->judul ?></h2>
                        <strong><?= $loker->nama_perusahaan ?></strong>
                    </div>
                    <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                        <span class="icon-room"></span> <?= $loker->lokasi ?>
                    </div>
                    <div class="job-listing-meta">
                        <span class="badge badge-danger"><?= $loker->type ?></span>
                    </div>
                </div>

            </li>
            <?php endforeach; ?>




        </ul>



    </div>
</section>


<section class="bg-light pt-5 testimony-full">

    <div class="owl-carousel single-carousel">


        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center text-center text-lg-left">
                    <blockquote>
                        <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero
                            dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum
                            repudiandae.&rdquo;</p>
                        <p><cite> &mdash; Corey Woods, @Dribbble</cite></p>
                    </blockquote>
                </div>
                <div class="col-lg-6 align-self-end text-center text-lg-right">
                    <img src="<?= base_url() ?>assets/images/person_transparent_2.png" alt="Image"
                        class="img-fluid mb-0">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center text-center text-lg-left">
                    <blockquote>
                        <p>&ldquo;Soluta quasi cum delectus eum facilis recusandae nesciunt molestias accusantium libero
                            dolores repellat id in dolorem laborum ad modi qui at quas dolorum voluptatem voluptatum
                            repudiandae.&rdquo;</p>
                        <p><cite> &mdash; Chris Peters, @Google</cite></p>
                    </blockquote>
                </div>
                <div class="col-lg-6 align-self-end text-center text-lg-right">
                    <img src="<?= base_url() ?>assets/images/person_transparent.png" alt="Image" class="img-fluid mb-0">
                </div>
            </div>
        </div>

    </div>

</section>

<section class="pt-5 bg-image overlay-primary fixed overlay"
    style="background-image: url('<?= base_url() ?>assets/images/hero_1.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-center text-center text-md-left mb-5 mb-md-0">
                <h2 class="text-white">Get The Mobile Apps</h2>
                <p class="mb-5 lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci
                    impedit.</p>
                <p class="mb-0">
                    <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span class="icon-apple mr-3"></span>App
                        Store</a>
                    <a href="#" class="btn btn-dark btn-md px-4 border-width-2"><span
                            class="icon-android mr-3"></span>Play Store</a>
                </p>
            </div>
            <div class="col-md-6 ml-auto align-self-end">
                <img src="<?= base_url() ?>assets/images/apps.png" alt="Image" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>