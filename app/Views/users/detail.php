<?= $this->extend('layout/detail_templates'); ?>

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
                <img class="image-detail img-fluid" src="<?= $base_api_url ?>/files/profile/<?= $data_playlist->profile_pict ?>" alt="">
            </div>

            <div class="col-12 col-md-6">
                <div class="row">

                    <!-- BANNER DETAIL JUDUL -->

                    <div class="col-12">
                        <h1 class="text-detail"><?= $data_playlist->nama_playlist ?></h1>
                    </div>

                    <!-- BANNER DETAIL DESKRIPSI -->

                    <div class="col-12">
                        <p class="text-detail-des"><?= $data_playlist->deskripsi ?></p>
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
                            <p class="likes"><?= $data_playlist->views ?> Views</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BANNER DETAIL SECTION END -->

            <!-- VIEWS CONTENT SECTION-->

            <?php if ($content): ?>

            <?php if ($category == 1): ?>

            <?= $this->include('konten_playlist/iframe'); ?>

            <?php elseif ($category == 2): ?>

            <?= $this->include('konten_playlist/catatan'); ?>

            <?php elseif ($category == 3): ?>

            <?= $this->include('konten_playlist/iframe') ?>

            <?php elseif ($category == 4): ?>

            <?= $this->include('konten_playlist/video') ?>

            <?php elseif ($category == 5): ?>

            <?= $this->include('konten_playlist/youtube') ?>

            <?php endif; ?>

            <?php endif; ?>

            <!-- VIEWS CONTENT SECTION END -->

            <!-- PLAYLIST CONTENT SECTION -->

            <div class="col-12">
                <p style="margin-top: 30px;"><b>Daftar Konten PlayList :</b></p>
            </div>

            <!-- KONTEN -->

            <!-- START -->
            
            <?php if ($materi): ?>

            <?php $index = 0; foreach ($materi as $konten): $index++; ?>

            <div class="col-2 col-md-2">
                <div class="number<?php if($current_uri == $konten->id_materi): ?>-active<?php endif; ?>">
                    <b><?= $index ?></b>
                </div>
            </div>

            <div class="col-10 col-md-10">
                <div class="text-daftar-konten<?php if($current_uri == $konten->id_materi): ?>-active<?php endif; ?>"
                    onclick="window.location.href='<?= base_url() ?>/detail-playlist/<?= $data_playlist->id_playlist ?>/<?= $konten->id_materi ?>';">
                    <p><?= $konten->nama_materi ?></p>
                </div>
            </div>

            <!-- END 1 -->

            <?php endforeach; ?>

            <?php else: ?>

            <div class="col-10 col-md-10">
                <p>Belum ada materi</p>
            </div>

            <?php endif; ?>

            <!-- PLAYLIST CONTENT SECTION END -->
        </div>
    </div>
</div>
<?= $this->endSection(); ?>