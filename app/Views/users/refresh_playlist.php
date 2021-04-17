<div class="row">
    <div class="col-12">
        <h5>Rekomendasi <?= $rekomendasi_title ?>
        
        <?php if($rekomendasi_title): ?>

        <a href="#rekomendasi" style="font-size: 12px; color: orange; padding-left: 10px;" onclick="filter_kategori(this, '');">Reset</a>

        <?php endif?>

        </h5>
    </div>

    <div id="added-success" class="alert alert-success col-12" role="alert" style="display: none; font-size: 12px;">
        Added to Bookmark
    </div>

    <div id="added-fail" class="alert alert-danger col-12" role="alert" style="display: none; font-size: 12px;">
        Add to Bookmark Failed
    </div>

    <div id="deleted-success" class="alert alert-success col-12" role="alert" style="display: none; font-size: 12px;">
        Deleted from Bookmark
    </div>

    <div id="deleted-fail" class="alert alert-danger col-12" role="alert" style="display: none; font-size: 12px;">
        Delete from Bookmark Failed
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

                <div class="col-12">
                    <i class="far fa-bookmark 
                        book-rekomen<?php if ($rekomendasi->marked_at): ?>-active<?php endif; ?>
                        book-<?= $rekomendasi->id_playlist ?>"
                        onclick="event.stopPropagation(); <?php if ($rekomendasi->marked_at): ?>delete_bookmark(<?= $rekomendasi->id_playlist ?>);<?php else: ?>add_bookmark(<?= $rekomendasi->id_playlist ?>);<?php endif; ?>">
                    </i>
                    <i class="far fa-heart heart-rekomen"
                        onclick="event.stopPropagation(); alert('heart');"></i>
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