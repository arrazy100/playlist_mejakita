<div class="col-12">
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

    <div class="foot">
    </div>
</div>

<?= $this->include('konten_playlist/pdfviewer'); ?>