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
        
        <video
            id="my-video"
            class="video-js embed-responsive-item"
            controls
            preload="auto"
            width="640"
            height="264"
            poster="MY_VIDEO_POSTER.jpg"
            data-setup="{}"
            >
            <source src="<?= $content ?>" type="video/mp4" />
            <source src="<?= $content ?>" type="video/webm" />
            <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank"
                >supports HTML5 video</a
                >
            </p>
        </video>
    </div>

    <div class="foot">
    </div>
</div>