<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

<div class="main">
    <div class="container">
        <div class="row">

            <!-- BANNER DETAIL SECTION -->

            <div class="col-12">
                <a href="<?= base_url() ?>/">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <!-- BANNER DETAIL IMAGE -->

            <div class="col-12 col-md-6">
                <img class="image-detail img-fluid" src="<?= base_url() ?>/assets/img/3255539.jpg" alt="">
            </div>

            <div class="col-12 col-md-6">
                <div class="row">

                    <!-- BANNER DETAIL JUDUL -->

                    <div class="col-12">
                        <h1 class="text-detail">Biologi - DNA</h1>
                    </div>

                    <!-- BANNER DETAIL DESKRIPSI -->

                    <div class="col-12">
                        <p class="text-detail-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit nisi sed sollicitudin pellentesque. Nunc posuere purus rhoncus pulvinar aliquam. Ut aliquet tristique nisl vitae volutpat.</p>
                    </div>

                    <!-- BANNER DETAIL VIEWS AND SEE -->

                    <div class="col-12 col-md-6 d-flex">
                        <div class="col">
                            <i class="far fa-heart heart-detail"></i>
                        </div>
                        <div class="col-12">
                            <p class="likes">1.000.000 Likes</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex">
                        <div class="col">
                            <i class="far fa-eye"></i>
                        </div>
                        <div class="col-12">
                            <p class="likes">1.000.000 Views</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BANNER DETAIL SECTION END -->

            <!-- VIEWS CATATAN SECTION-->

            <div class="col-12">
                <!-- HEADER -->

                <div class="header">
                    <div class="row">
                        <div class="col-6">
                            <p style="color: #FFFFFF; margin-top: 10px"><b>Catatan</b></p>
                        </div>
                        <div class="col-6 d-flex justify-content-end" style="margin-top: 10px;">
                            <button id="zoomIn" class="btn btn-zoom" style="margin-right: 5px;">+</button>
                            <button id="zoomOut" class="btn btn-zoom">-</button>
                        </div>
                    </div>
                </div>

                <!-- PDF -->

                <input type="hidden" id="pdf" value="<?= $pdf; ?>">

                <div id="pdf-container" class="embed-responsive embed-responsive-16by9" style="overflow-y: scroll; overflow-x: scroll;">
                    <div id="viewer" class="pdfViewer embed-responsive-item"></div>
                </div>

                <!-- FOOTER -->

                <div class="foot">
                </div>
            </div>

            <!-- VIEWS CATATAN SECTION END -->

            <!-- VIEWS DISKUSI PR SECTION -->

            <!-- HEADER -->
            <div class="col-12" style="display: none;">
                <div class="header">
                    <div class="row">
                        <div class="col-6">
                            <p style="color: #FFFFFF; margin-top: 10px"><b>Diskusi PR</b></p>
                        </div>
                    </div>
                </div>

                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="<?= base_url() ?>" class="embed-responsive-item" frameborder="0""></iframe>
                </div>

                <!-- FOOTER -->

                <div class="foot">
                </div>
            </div>

            <!-- VIEWS DISKUSI PR SECTION END -->

            <!-- VIEWS VIDEO SECTION -->

            <!-- HEADER -->
            <div class="col-12" style="display: none;">
                <div class="header">
                    <div class="row">
                        <div class="col-6">
                            <p style="color: #FFFFFF; margin-top: 10px"><b>Video</b></p>
                        </div>
                    </div>
                </div>

                <div class="embed-responsive embed-responsive-16by9" style="margin-top: 30px;">
                    <iframe src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" class="embed-responsive-item" frameborder="0" allowfullscreen></iframe>
                </div>

                <!-- FOOTER -->

                <div class="foot">
                </div>
            </div>

            <!-- VIEWS VIDEO SECTION END -->

            <!-- PLAYLIST CONTENT SECTION -->

            <div class="col-12">
                <p style="margin-top: 30px;"><b>Daftar Konten PlayList :</b></p>
            </div>

            <!-- KONTEN -->

            <!-- START -->

            <div class="col-2 col-md-2">
                <div class="number">
                    <b>1</b>
                </div>
            </div>

            <div class="col-10 col-md-10">
                <div class="text-daftar-konten">
                    <p>Diskusi PR - Biologi DNA</p>
                </div>
            </div>

            <!-- END 1 -->

            <div class="col-2 col-md-2">
                <div class="number-active">
                    <b>2</b>
                </div>
            </div>

            <div class="col-10 col-md-10">
                <div class="text-daftar-konten-active">
                    <p>Catatan - Biologi DNA</p>
                </div>
            </div>

            <!-- END 2 -->

            <div class="col-2 col-md-2">
                <div class="number">
                    <b>3</b>
                </div>
            </div>

            <div class="col-10 col-md-10">
                <div class="text-daftar-konten">
                    <p>Link Referensi - Biologi DNA</p>
                </div>
            </div>

            <div class="col-2 col-md-2">
                <div class="number">
                    <b>4</b>
                </div>
            </div>

            <!-- END 3 -->

            <div class="col-10 col-md-10">
                <div class="text-daftar-konten">
                    <p>Video - Biologi DNA</p>
                </div>
            </div>

            <!-- END 4 -->

            <!-- PLAYLIST CONTENT SECTION END -->

            <!-- DETAIL REKOMENDASI SECTION -->

            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h5 style="margin: 30px 0;">Rekomendasi</h5>
                    </div>

                    <!-- START -->

                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="rekomen-img">
                            <img src="<?= base_url() ?>/assets/img/hero_img.png" class="img-thumbnail" alt="...">
                            <div class="row">
                                <div class="col-12">
                                    <p class="judul-rekomen"><b>Biologi - DNA</b></p>
                                </div>
                                <div class="col-12">
                                    <p class="views-rekomen">200.000.000 Views</p>
                                </div>
                                <div class="col-12">
                                    <i class="far fa-bookmark book-rekomen"></i>
                                    <i class="far fa-heart heart-rekomen"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- END 1 -->

                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="rekomen-img">
                            <img src="<?= base_url() ?>/assets/img/hero_img.png" class="img-thumbnail" alt="...">
                            <div class="row">
                                <div class="col-12">
                                    <p class="judul-rekomen"><b>Biologi - DNA</b></p>
                                </div>
                                <div class="col-12">
                                    <p class="views-rekomen">200.000.000 Views</p>
                                </div>
                                <div class="col-12">
                                    <i class="far fa-bookmark book-rekomen"></i>
                                    <i class="far fa-heart heart-rekomen"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- END 2 -->

                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="rekomen-img">
                            <img src="<?= base_url() ?>/assets/img/hero_img.png" class="img-thumbnail" alt="...">
                            <div class="row">
                                <div class="col-12">
                                    <p class="judul-rekomen"><b>Biologi - DNA</b></p>
                                </div>
                                <div class="col-12">
                                    <p class="views-rekomen">200.000.000 Views</p>
                                </div>
                                <div class="col-12">
                                    <i class="far fa-bookmark book-rekomen"></i>
                                    <i class="far fa-heart heart-rekomen"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- END 3 -->

                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="rekomen-img">
                            <img src="<?= base_url() ?>/assets/img/hero_img.png" class="img-thumbnail" alt="...">
                            <div class="row">
                                <div class="col-12">
                                    <p class="judul-rekomen"><b>Biologi - DNA</b></p>
                                </div>
                                <div class="col-12">
                                    <p class="views-rekomen">200.000.000 Views</p>
                                </div>
                                <div class="col-12">
                                    <i class="far fa-bookmark book-rekomen"></i>
                                    <i class="far fa-heart heart-rekomen"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- END 4 -->

                </div>
            </div>

            <!-- DETAIL REKOMENDASI SECTION END -->
        </div>
    </div>
</div>
<?= $this->include('layout/pdfviewer'); ?>
<?= $this->endSection(); ?>