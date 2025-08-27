<?= $this->extend('layouts/admin.php'); ?>

<?= $this->section('content'); ?>

<!-- <div class="col-xl-12 xl-60 box-col-12">
    <div class="card">
        <div class="job-search">
            <div class="card-body pb-0">
                <div class="d-flex"><img class="img-40 img-fluid m-r-20"
                        src="<= base_url() ?>admin/assets/images/job-search/1.jpg" alt="">
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
                    <h4 class="mb-0"><= $judul ?> </h4>
                    <form class="form theme-form" method="POST" action="<= url_to('kategori.store') ?>">
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
</div> -->
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
                <form class="form theme-form" method="POST" action="<?= url_to('loker.store') ?>"
                    enctype="multipart/form-data">
                    <div class="job-description">
                        <h4 class="mb-0"> <?= $judul ?></h4>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="judul">Nama Loker:<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" id="judul" type="text" placeholder="Masukkan Nama Loker"
                                        name="judul">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="nama_perusahaan">Nama Perusahaan :<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" id="nama_perusahaan" type="text"
                                        placeholder="Masukkan Nama Perusahaan Loker" name="nama_perusahaan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="lokasi">Lokasi Loker:<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" id="lokasi" type="text"
                                        placeholder="Masukkan Lokasi Loker" name="lokasi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="email">Email Perusahaan:<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" id="email" name="email" type="email"
                                        placeholder="Enter email">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xxl-4 col-sm-6"> -->
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="col-form-label" for="myInput">Gaji</label>
                                    <!-- <input class="form-control" id="myInput2" name="gaji" type="text"
                                        placeholder="Enter Gaji"> -->
                                    <input class="form-control" id="myInput" name="gaji" type="text"
                                        placeholder="Enter Gaji">
                                </div>
                            </div>
                        </div>

                        <div class="row select-date">
                            <div class="col-xl-6 xl-100">
                                <div class="mb-3">
                                    <!-- <label class="form-label" for="exampleFormControlInput5">Lama Pengalaman:<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" id="exampleFormControlInput5" type="number"
                                        placeholder="Enter Lama Pengalaman"> -->
                                    <label class="col-form-label text-end pt-0">Pengalaman:<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" name="lama_pengalaman" type="text"
                                        placeholder="Enter Pengalaman">
                                </div>
                            </div>
                            <div class="col-xl-6 xl-100 xl-mt-job">
                                <label class="col-form-label text-end pt-0">Publish:<span
                                        class="font-danger">*</span></label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input class="datepicker-here form-control digits" type="text"
                                                data-language="en" placeholder="Publish Loker" name="publish">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 xs-mt-period">
                                        <div class="input-group">
                                            <input class="datepicker-here form-control digits" type="text"
                                                data-language="en" placeholder="Batas Waktu" name="batas_waktu">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 xl-100">
                                <div class="mb-3">
                                    <div class="col-form-label pt-0">Type:<span class="font-danger">*</span>
                                    </div>
                                    <select class="js-example-basic-single col-sm-12 job-select2" name="type">
                                        <optgroup label="Choose a Option">
                                            <option value="fulltime">Fulltime</option>
                                            <option value="parttime">Parttime</option>
                                            <option value="internship">Internship</option>
                                            <option value="freelance">Freelance</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 xl-100">
                                <div class="mb-3">
                                    <div class="col-form-label pt-0">Kategori:<span class="font-danger">*</span>
                                    </div>
                                    <select class="js-example-basic-single col-sm-12 job-select2" name="id_kategori">
                                        <optgroup label="Choose a Option">
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($kategoris as $value): ?>
                                                <option value="<?= $value['id'] ?>"><?= $value['nama'] ?></option>
                                            <?php endforeach ?>

                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 xl-100">
                                <div class="mb-3">
                                    <div class="col-form-label pt-0">Jenis Kelamin:<span class="font-danger">*</span>
                                    </div>
                                    <select class="js-example-basic-single col-sm-12 job-select2" name="jk">
                                        <optgroup label="Choose a Option">
                                            <option value="">Pilih Jenis kelamin</option>
                                            <option value="lk">Laki Laki</option>
                                            <option value="pr">Perempuan</option>
                                            <option value="all">Semua</option>

                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 xl-100">
                                <div class="mb-3">
                                    <label class="form-label" for="exampleFormControlInput6">Jumlah Posisi:<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" id="exampleFormControlInput6" name="slot" type="number"
                                        placeholder="Enter Posisi">
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-0">Upload Your Files</h4>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="col-form-label pt-0">Banner Loker :<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" type="file" name="gambar">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="col-form-label pt-0">Logo Perusahaan:<span
                                            class="font-danger">*</span></label>
                                    <input class="form-control" type="file" name="logo_perusahaan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label>Deskripsi</label>
                                    <textarea id="text-box" name="deskripsi" class="form-control"
                                        id="exampleFormControlTextarea4" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label>Tanggung Jawab</label>
                                    <textarea id="editor1" name="tanggung_jawab" class="form-control"
                                        id="exampleFormControlTextarea4" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label>Pendidikan Terakhir</label>
                                    <textarea id="editor2" name="pendidikan_terakhir" class="form-control"
                                        id="exampleFormControlTextarea4" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div>
                                    <label>Manfaat Lainnya</label>
                                    <textarea id="editor3" name="manfaat_lainnya" class="form-control"
                                        id="exampleFormControlTextarea4" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row select-date my-2">

                            <div class="col-xl-6 xl-100">
                                <div class="mb-3">
                                    <label>Enter some Details</label>
                                    <textarea id="text-box4" class="form-control" id="exampleFormControlTextarea4"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 xl-100">
                                <div class="mb-3">
                                    <label>Enter some Details</label>
                                    <textarea id="text-box2" class="form-control" id="exampleFormControlTextarea4"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 xl-100">
                                <div class="mb-3">
                                    <label>Enter some Details</label>
                                    <textarea id="text-box3" class="form-control" id="exampleFormControlTextarea4"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 xl-100">
                                <div class="mb-3">
                                    <label>Enter some Details</label>
                                    <textarea id="text-box" class="form-control" id="exampleFormControlTextarea4"
                                        rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                    </div> -->
                        <!-- <div class="email-wrapper">
                        <div class="theme-form">
                            <div class="mb-3">
                                <label>Content:</label>
                                <textarea id="text-box" name="text-box" cols="10" rows="2"></textarea>
                            </div>
                        </div>
    
                    </div> -->

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