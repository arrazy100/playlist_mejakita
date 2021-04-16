<div class="col-12" id="content">
    <div class="header">
        <div class="row">
            <div class="col-6">
                <p style="color: #FFFFFF; margin-top: 10px"><b><?= $nama_konten ?></b></p>
            </div>
        </div>
    </div>

    <div class="embed-responsive embed-responsive-16by9" style="margin-top: 30px;">
        <div style="position: absolute; top: 50%; left: 50%;">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <iframe src="<?= $content ?>" class="embed-responsive-item" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="foot">
    </div>
</div>