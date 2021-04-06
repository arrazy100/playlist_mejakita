<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

<style>
    .terbaru-list {
        position: static;
        box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.3);
        margin-top: 20px;
        background-color: blue;
    }

    #content-list {
        padding-left: 0px;
        min-height: 300px;
        max-height: 300px;
    }

    .content-item {
        background-color: white;
        box-shadow: 0 8px 6px -6px rgba(0, 0, 0, 0.3);
        padding: 2px;
        margin-bottom: 20px;
        z-index: 0;
    }

    .content-item:hover {
        cursor: pointer;
    }

    .content-item-title {
        font-weight: 900;
        font-size: 1rem;
        color: #3f3f3f;
    }

    .content-item-date, .content-item-views {
        font-size: 0.8rem;
        color: #3f3f3f;
    }
    
    .scrollable-list {
        overflow-y: hidden;
    }

    .scroll-active {
        overflow-y: scroll;
    }

    .carousel-inner > .carousel-item > img {
        height: 300px;
    }

    .carousel-control {
        margin-right: 20px;
    }

    .carousel-control-prev-icon:after {
        content: '<';
        font-size: 2rem;
        color: black;
    }

    .carousel-control-next-icon:after {
        content: '>';
        font-size: 2rem;
        color: black;
    }

    .view-more {
        display: flex;
        padding: 30px 0 0px 20px;
    }

    .view-more p {
        font-size: 1rem;
        font-weight: bold;
        color: rgba(0, 0, 0, 0.7);
    }

    .view-more p:hover {
        cursor: pointer;
    }

    @media (min-width: 992px) {
        .terbaru-list {
            min-width: 50vw;
            position: absolute;
            top: 20%;
            left: -30%;
            box-shadow: 0 5px 10px rgba(154,160,185,.05), 0 15px 40px rgba(166,173,201,.2);;
            background-color: white;
        }
    }
</style>

<script>
    function toggleScroll() {
        document.getElementById("content-list").classList.toggle("scroll-active");
    };
</script>

<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 style="margin: 20px 0 10px 0;">Terbaru</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div id="playlist-carousel" class="carousel slide w-100" data-ride="carousel">
                    <ol class="carousel-indicators" style="top: 75%; position: relative;">
                        <li data-target="#playlist-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#playlist-carousel" data-slide-to="1"></li>
                        <li data-target="#playlist-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?= base_url() ?>/assets/img/profile-default.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url() ?>/assets/img/profile-default.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?= base_url() ?>/assets/img/profile-default.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="row">
                    <div class="col-12 d-flex d-inline-block" style="margin-top: 30px;">
                        <div class="dropdown" style="margin-right: 10px;">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="bulan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Bulan
                            </a>
                            <div class="dropdown-menu" aria-labelledby="bulan">
                                <a class="dropdown-item" href="#">Januari</a>
                                <a class="dropdown-item" href="#">Februari</a>
                                <a class="dropdown-item" href="#">Maret</a>
                                <a class="dropdown-item" href="#">April</a>
                                <a class="dropdown-item" href="#">Mai</a>
                                <a class="dropdown-item" href="#">Juni</a>
                                <a class="dropdown-item" href="#">Juli</a>
                                <a class="dropdown-item" href="#">Agustus</a>
                                <a class="dropdown-item" href="#">September</a>
                                <a class="dropdown-item" href="#">Oktober</a>
                                <a class="dropdown-item" href="#">November</a>
                                <a class="dropdown-item" href="#">Desember</a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="tahun" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tahun
                            </a>
                            <div class="dropdown-menu" aria-labelledby="tahun">
                                <a class="dropdown-item" href="#">2020</a>
                                <a class="dropdown-item" href="#">2021</a>
                            </div>
                        </div>

                        <div class="col d-flex justify-content-center">
                            <a class="carousel-control" href="#playlist-carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control" href="#playlist-carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-12 terbaru-list" style="background-color: white;">
                        <div class="col-12">
                            <h5>Biologi</h5>
                        </div>
                        <div class="col-12 scrollable-list" id="content-list">
                            <div class="content-item">
                                <div class="col">
                                    <p class="content-item-title">Playlist Belajar untuk Persiapan UTS Biologi</p>
                                </div>
                                <div class="col">
                                    <p class="content-item-date">Februari 2021</p>
                                </div>
                                <div class="col">
                                    <p class="content-item-views">1.000.000 Views</p>
                                </div>
                            </div>

                            <!-- END 1 -->

                            <div class="content-item">
                                <div class="col">
                                    <p class="content-item-title">Playlist Belajar untuk Persiapan UTS Biologi</p>
                                </div>
                                <div class="col">
                                    <p class="content-item-date">Februari 2021</p>
                                </div>
                                <div class="col">
                                    <p class="content-item-views">1.000.000 Views</p>
                                </div>
                            </div>

                            <!-- END 2 -->

                            <div class="content-item">
                                <div class="col">
                                    <p class="content-item-title">Playlist Belajar untuk Persiapan UTS Biologi</p>
                                </div>
                                <div class="col">
                                    <p class="content-item-date">Februari 2021</p>
                                </div>
                                <div class="col">
                                    <p class="content-item-views">1.000.000 Views</p>
                                </div>
                            </div>

                            <!-- END 3 -->

                        </div>

                        <div class="col-12 view-more">
                            <p onclick="toggleScroll();">View More</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>