<?= $this->extend('layout/templates'); ?>

<?= $this->section('content'); ?>

<main>
    <div class="row">

        <!-- BANNER SECTION -->

        <div class="col-12 banner">
            <div class="container">
                <div class="row">
                    <!-- IMAGE BANNER -->
                    <div class="col-12 col-md-6">
                        <img class="ban-image img-fluid" src="<?= base_url() ?>/assets/img/3255539.jpg" alt="">
                    </div>

                    <!-- TEXT AND BUTTON -->

                    <div class="col-12 col-md-6 text-btn">

                        <!-- PLAYLIST -->

                        <div class="col-12">
                            <h1 class="ban-text">Playlist Belajar</h1>
                        </div>

                        <!-- DETAIL PLAYLIST -->

                        <div class="col-12">
                            <p class="ban-text-detail">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit nisi sed sollicitudin pellentesque. Nunc posuere purus rhoncus pulvinar aliquam. Ut aliquet tristique nisl vitae volutpat.</p>
                        </div>

                        <!-- BOOKMARKED -->

                        <div class="col-12 btn-bookmarked">
                            <div class="row float-md-right">
                                <?php if ($user): ?>

                                <div class="col">
                                    <button class="btn btn-bookmark" onclick="window.location.href='<?= base_url() ?>/bookmarked';">Dashboard</button>
                                </div>

                                <div class="col">
                                    <button class="btn btn-bookmark" onclick="window.location.href='<?= base_url() ?>/bookmarked';">Bookmarked</button>
                                </div>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BANNER SECTION END -->

        <div class="container">
            <div class="row">

                <!-- REKOMENDASI SECTION -->

                <input type="hidden" id="protection_token" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                    <div class="col-12 col-lg-8" id="rekomendasi">
                        <div class="row">
                            <div class="col-12">
                                <h5>Rekomendasi</h5>
                            </div>

                            <div id="added-success" class="alert alert-success col-12" role="alert" style="display: none; font-size: 12px;">
                                Added to Bookmark
                            </div>

                            <div id="added-fail" class="alert alert-danger col-12" role="alert" style="display: none; font-size: 12px;">
                                Add to Bookmark Failed, REST API Error
                            </div>

                            <div id="deleted-success" class="alert alert-success col-12" role="alert" style="display: none; font-size: 12px;">
                                Deleted from Bookmark
                            </div>

                            <div id="deleted-fail" class="alert alert-danger col-12" role="alert" style="display: none; font-size: 12px;">
                                Delete from Bookmark Failed, REST API Error
                            </div>

                            <!-- START -->
                            <?php if ($daftar_rekomendasi): ?>

                            <?php foreach($daftar_rekomendasi as $rekomendasi):?>

                            <div class="col-12 col-sm-6 col-xl-4">
                                <div class="rekomen-img" onclick="window.location.href='<?= base_url() ?>/detail-playlist/<?= $rekomendasi->id_playlist ?>';">
                                    <img src="<?= $base_api_url ?>/files/profile/<?= $rekomendasi->profile_pict ?>" class="img-thumbnail" alt="...">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="judul-rekomen text-truncate"><b><?= $rekomendasi->nama_playlist ?></b></p>
                                        </div>
                                        <div class="col-12">
                                            <p class="views-rekomen"><?= $rekomendasi->views?> Views</p>
                                        </div>

                                        <?php if ($user): ?>

                                        <div class="col-12" style="margin-bottom: 10px;">
                                            <i class="far fa-bookmark 
                                                book-rekomen<?php if ($rekomendasi->marked_at): ?>-active<?php endif; ?>
                                                book-<?= $rekomendasi->id_playlist ?>"
                                                onclick="event.stopPropagation(); <?php if ($rekomendasi->marked_at): ?>delete_bookmark(<?= $rekomendasi->id_playlist ?>);<?php else: ?>add_bookmark(<?= $rekomendasi->id_playlist ?>);<?php endif; ?>">
                                            </i>
                                            
                                        </div>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>

                            <?php else: ?>

                            <div class="col-12 col-sm-6 col-xl-4">
                                <p>Belum ada rekomendasi</p>
                            </div>

                            <?php endif; ?>

                            <!-- END -->
                        </div>
                    </div>

                    <!-- REKOMENDASI SECTION END -->

                    <div class="col-12 col-lg-4">
                        <div class="row">

                            <!-- KATEGORI SECTION -->

                            <div class="col-12">
                                <h5>Kategori</h5>
                            </div>

                            <?php if($kategori): ?>

                            <?php for($i = 0; $i < count($kategori); $i++): ?>

                            <div class="col-12 col-sm-6">
                                <button type="button" class="btn btn-block btn-primary btn-kategori text-truncate" onclick="filter_kategori(this, '<?= $kategori_slug[$i] ?>');"><?= $kategori[$i] ?></button>
                            </div>

                            <?php endfor; ?>

                            <?php endif; ?>

                            <!-- KATEGORI SECTION END -->

                            <!-- TOP PLAYLIST SECTION -->

                            <div class="col-12">
                                <h5 style="margin: 40px 0 10px 0;">Top PlayList</h5>
                            </div>

                            <!-- START -->

                            <?php if ($top_playlist): ?>
                            <?php foreach($top_playlist as $top): ?>
                            
                            <div class="col-3 col-lg-4">
                                <div class="top-playlist">
                                    <img class="img-fluid" src="<?= $base_api_url ?>/files/profile/<?= $top->profile_pict ?>" alt="">
                                </div>
                            </div>
                            <div class="col-9 col-lg-8">
                                <div class="row">
                                    <div class="col-10 col-lg-9" style="width: 100%;">
                                        <a class="card-detail" href="<?= base_url() ?>/detail-playlist/<?= $top->id_playlist ?>">
                                            <p class="judul-top-playlist text-truncate">
                                                <b><?= $top->nama_playlist ?></b>
                                            </p>    
                                        </a>
                                        <p class="views-top-playlist"><?= $top->views ?> Views</p>
                                    </div>

                                    <div class="col-2 col-lg-3 d-flex align-items-center">
                                        <?php if ($user): ?>

                                        <i class="far fa-bookmark 
                                            book-top-playlist<?php if ($top->marked_at): ?>-active<?php endif; ?>
                                            book-<?= $top->id_playlist ?>"
                                            onclick="event.stopPropagation(); <?php if ($top->marked_at): ?>delete_bookmark(<?= $top->id_playlist ?>);<?php else: ?>add_bookmark(<?= $top->id_playlist ?>);<?php endif; ?>">
                                        </i>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- END 1 -->

                            <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                    
                <!-- TOP PLAYLIST SECTION END -->

                    <!-- TERBARU SECTION -->

                    <div class="container" style="margin-bottom: 300px; margin-top: 50px;" id="terbaru">
                        <div class="row">
                            <div class="col-12">
                                <h5 style="margin: 20px 0 10px 0;">Terbaru</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 d-flex justify-content-center">
                                <div id="playlist-carousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php if($random_list): ?>

                                        <div class="carousel-item active" onclick="window.location.href='<?= base_url() ?>/detail-playlist/<?= $random_list[0]->id_playlist ?>';">
                                            <img src="<?= $base_api_url ?>/files/profile/<?= $random_list[0]->profile_pict ?>" class="w-100" alt="...">
                                        </div>
                                        <div class="carousel-item" onclick="window.location.href='<?= base_url() ?>/detail-playlist/<?= $random_list[1]->id_playlist ?>';">
                                            <img src="<?= $base_api_url ?>/files/profile/<?= $random_list[1]->profile_pict ?>" class="w-100" alt="...">
                                        </div>
                                        <div class="carousel-item" onclick="window.location.href='<?= base_url() ?>/detail-playlist/<?= $random_list[2]->id_playlist ?>';">
                                            <img src="<?= $base_api_url ?>/files/profile/<?= $random_list[2]->profile_pict ?>" class="w-100" alt="...">
                                        </div>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6" id="filter-bulantahun">
                                <div class="row">
                                    <div class="col-12 d-flex d-inline-block" style="margin-top: 30px;">
                                        <?php if ($terbaru_bulan): ?>

                                        <div class="dropdown" style="margin-right: 10px;">
                                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="bulan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Bulan
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="bulan">
                                                <a class="dropdown-item" href="#filter-bulantahun" onclick="filter_bulantahun('#bulan', this);">Bulan</a>

                                                <?php foreach ($terbaru_bulan as $bulan): ?>

                                                <a class="dropdown-item" href="#filter-bulantahun" onclick="filter_bulantahun('#bulan', this);"><?= $bulan ?></a>

                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <?php endif; ?>

                                        <?php if ($terbaru_tahun): ?>

                                        <div class="dropdown">
                                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="tahun" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Tahun
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="tahun">
                                                <a class="dropdown-item" href="#tahun" onclick="filter_bulantahun('#tahun', this);">Tahun</a>

                                                <?php foreach ($terbaru_tahun as $tahun): ?>

                                                <a class="dropdown-item" href="#tahun" onclick="filter_bulantahun('#tahun', this);"><?= $tahun ?></a>

                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <?php endif; ?>

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

                                    <div class="col-12 terbaru-list" style="background-color: #4da8da;">
                                        <div class="col-12" id="terbaru-filter-judul" style="color: #fff;"></div>
                                        <div class="col-12 scrollable-list" id="content-list" style="margin-top: 20px;">
                                            <?php if($terbaru):?>
                                            <?php foreach($terbaru as $l):?>

                                            <div class="content-item" onclick="window.location.href='<?= base_url() ?>/detail-playlist/<?= $l->id_playlist ?>';">
                                                <div class="col">
                                                    <p class="content-item-title text-truncate"><?= $l->nama_playlist ?></p>
                                                </div>
                                                <div class="col">
                                                    <p class="content-item-date"><?= date("d F Y", strtotime($l->created_at)) ?></p>
                                                </div>
                                                <div class="col">
                                                    <p class="content-item-views"><?= $l->views ?> Views</p>
                                                </div>
                                            </div>

                                            <!-- END 1 -->

                                            <?php endforeach;?>

                                            <?php else: ?>

                                            <p style="color: white;">Tidak ada data</p>

                                            <?php endif;?>

                                        </div>

                                        <div class="col-12 view-more">
                                            <?php if(count($terbaru) > 2): ?>

                                            <p onclick="toggleScroll();">View More</p>

                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TERBARU SECTION END -->

                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>