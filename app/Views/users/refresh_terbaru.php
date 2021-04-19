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