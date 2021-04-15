<?= $this->extend('layout/bookmarked_templates'); ?>

<?= $this->section('content'); ?>

<main>
    <div class="container" style=" ">
        <div class="row">
            <!-- BANNER DETAIL SECTION -->

            <div class="col-12">
                <a href="<?= base_url() ?>/">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <div class="container">
                <div class="row">

                    <!-- BOOKMARKED SECTION -->

                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <h5>Bookmarked</h5>
                        </div>

                        <input type="hidden" id="protection_token" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

                        <!-- START -->
                        <div class="row">
                            <?php if ($list): ?>

                            <?php foreach ($list as $l): ?>

                            <div class="col-md-6" id="book-<?= $l->id_playlist ?>">
                                <div class="row bookmarked-img">
                                    <div class="col-lg-6 col-xl-6">
                                        <img src="<?= $base_api_url ?>/files/profile/<?= $l->profile_pict ?>"" class="img-thumbnail1 mx-auto d-block" alt="...">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-body" style="padding-left:0;">
                                            <div>
                                                <p class="judul-rekomen text-truncate"><b><?= $l->nama_playlist ?></b></p>
                                                <p class="views-rekomen"><?= $l->views ?> Views</p>
                                            </div>
                                            <div style="display: inline-block; margin-left: 20px; vertical-align: top; margin-top: 12px">
                                                <i class="far fa-bookmark book-rekomen-active" onclick="delete_bookmark(<?= $l->id_playlist ?>);"></i>
                                                <i class="far fa-heart heart-rekomen"></i>
                                            </div>
                                            <div class="col-2 ">
                                                <button type="button" class="btn see-more1" onclick="location.href='/detail-playlist/<?= $l->id_playlist ?>';">See More</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END 1 -->

                            <?php endforeach; ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>