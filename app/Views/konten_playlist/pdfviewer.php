<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.min.js" integrity="sha512-g4FwCPWM/fZB1Eie86ZwKjOP+yBIxSBM/b2gQAiSVqCgkyvZ0XxYPDEcN2qqaKKEvK6a05+IPL1raO96RrhYDQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf_viewer.js" integrity="sha512-WBiA7Xu6uie6Tk2fqnQnXHWbDFrkzDMlUfALYEJI9/eQtQ4kHcO1AbZA9wGqQ48Nkx7EUs9dXSAvW50ZYIQq+A==" crossorigin="anonymous"></script>

<script>
    // Loaded via <script> tag, create shortcut to access PDF.js exports.
    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    var pdfjsViewer = window['pdfjs-dist/web/pdf_viewer'];

    if (!pdfjsLib.getDocument || !pdfjsViewer.PDFViewer) {
        alert("Please build the pdfjs-dist library");
    }

    const USE_ONLY_CSS_ZOOM = true;
    const TEXT_LAYER_MODE = 0;
    const MAX_IMAGE_SIZE = 1024 * 1024;
    const CMAP_URL = "pdfjs-dist/cmaps/";
    const CMAP_PACKED = true;

    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.worker.min.js';

    const DEFAULT_URL = "<?= base_url() ?>/assets/files/pdf.pdf";
    const DEFAULT_SCALE_DELTA = 1.1;
    const MIN_SCALE = 0.5;
    const MAX_SCALE = 10.0;
    const DEFAULT_SCALE_VALUE = "auto";

    const PDFViewerApplication = {
        pdfLoadingTask: null,
        pdfDocument: null,
        pdfViewer: null,
        pdfHistory: null,
        pdfLinkService: null,
        eventBus: null,

        open(params) {
            if (this.pdfLoadingTask) {
                return this.close().then(function() {
                    return this.open(params);
                }.bind(this));
            }

            const pdf = params.pdf;
            const self = this;
            
            const loadingTask = pdfjsLib.getDocument({
                data: pdf,
                maxImageSize: MAX_IMAGE_SIZE,
                cMapUrl: CMAP_URL,
                cMapPacked: CMAP_PACKED,
            });

            this.pdfLoadingTask = loadingTask;

            loadingTask.onProgress = function (progressData) {
                self.progress(progressData.loaded / progressData.total);
            };

            return loadingTask.promise.then(
                function (pdfDocument) {
                    self.pdfDocument = pdfDocument;
                    self.pdfViewer.setDocument(pdfDocument);
                    self.pdfLinkService.setDocument(pdfDocument);
                }
            );
        },
        close() {
            if (!this.pdfLoadingTask) {
                return Promise.resolve();
            }

            const promise = this.pdfLoadingTask.destroy();
            this.pdfLoadingTask = null;

            if (this.pdfDocument) {
                this.pdfDocument = null;

                this.pdfViewer.setDocument(null);
                this.pdfLinkService.setDocument(null, null);
            }

            return promise;
        },

        progress: function pdfViewProgress(level) {
            const percent = Math.round(level * 100);
        },

        get pagesCount() {
            return this.pdfDocument.numPages;
        },

        get page() {
            return this.pdfViewer.currentPageNumber;
        },

        set page(val) {
            this.pdfViewer.currentPageNumber = val;
        },

        rescale: function pdfRescale() {
            this.pdfViewer.currentScaleValue = "auto";
        },

        zoomIn: function pdfViewZoomIn(ticks) {
            let newScale = this.pdfViewer.currentScale;
            do {
                newScale = (newScale * DEFAULT_SCALE_DELTA).toFixed(2);
                newScale = Math.ceil(newScale * 10) / 10;
                newScale = Math.min(MAX_SCALE, newScale);
            } while (--ticks && newScale < MAX_SCALE);
            this.pdfViewer.currentScaleValue = newScale;
        },

        zoomOut: function pdfViewZoomOut(ticks) {
            let newScale = this.pdfViewer.currentScale;
            do {
                newScale = (newScale / DEFAULT_SCALE_DELTA).toFixed(2);
                newScale = Math.floor(newScale * 10) / 10;
                newScale = Math.max(MIN_SCALE, newScale);
            } while (--ticks && newScale > MIN_SCALE);
            this.pdfViewer.currentScaleValue = newScale;
        },

        initUI: function pdfViewInitUI() {
            const eventBus = new pdfjsViewer.EventBus();
            this.eventBus = eventBus;

            const linkService = new pdfjsViewer.PDFLinkService({
                eventBus,
            });

            this.pdfLinkService = linkService;

            this.l10n = pdfjsViewer.NullL10n;

            const container = document.getElementById("pdf-container");
            const pdfViewer = new pdfjsViewer.PDFViewer({
                container,
                eventBus,
                linkService,
                l10n: this.l10n,
                useOnlyCssZoom: USE_ONLY_CSS_ZOOM,
                textLayerMode: TEXT_LAYER_MODE,
            });

            this.pdfViewer = pdfViewer;
            linkService.setViewer(pdfViewer);

            window.addEventListener("resize", function(event) {
                PDFViewerApplication.rescale();
            });

            document.getElementById("zoomIn").addEventListener("click", function() {
                PDFViewerApplication.zoomIn();
            });

            document.getElementById("zoomOut").addEventListener("click", function() {
                PDFViewerApplication.zoomOut();
            });

            eventBus.on("pagesinit", function() {
                pdfViewer.currentScaleValue = DEFAULT_SCALE_VALUE;
            });

            eventBus.on("pagechanging", function(evt) {
                const page = evt.pageNumber;
                const numPages = PDFViewerApplication.pagesCount;
            }, true);
        },
    };

    window.PDFViewerApplication = PDFViewerApplication;

    var pdf = document.getElementById("pdf").value;
    pdf = atob(pdf);

    document.addEventListener("DOMContentLoaded", function () {
        PDFViewerApplication.initUI();
    }, true);

    const animationStarted = new Promise(function (resolve) {
        window.requestAnimationFrame(resolve);
    });

    animationStarted.then(function () {
        PDFViewerApplication.open({
            pdf: pdf,
        });   
    });
</script>