<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading: {{ $book->title }} - Readora</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <style>
        :root {
            --primary-color: #710014;
            --primary-dark: #5a0010;
            --secondary-color: #64748b;
            --background-color: #f2f1ed;
            --surface-color: #ffffff;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-primary);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Header */
        .reader-header {
            background: var(--surface-color);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .book-info h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
            font-size: 1.5rem;
        }

        .book-info .author {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin: 0;
        }

        .header-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .control-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--surface-color);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.5rem;
        }

        .cta-button {
            background: var(--primary-color);
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .cta-button:hover {
            background: #5a0010;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .cta-button:disabled {
            background: var(--secondary-color);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            opacity: 0.7;
        }

        /* Button Control Styling for Zoom Controls */
        .button-control {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .button-control:hover {
            background: #5a0010;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .button-control:disabled {
            background: var(--secondary-color);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            opacity: 0.7;
        }

        .button-control.small {
            padding: 8px 16px;
            font-size: 0.9rem;
        }


        .page-input,
        .zoom-control {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.5rem;
            font-size: 0.9rem;
            background: var(--surface-color);
        }

        .page-input {
            width: 60px;
            text-align: center;
        }

        .zoom-control {
            min-width: 80px;
        }

        /* Main Content */
        .reader-container {
            display: flex;
            min-height: calc(100vh - 100px);
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            gap: 2rem;
        }

        .pdf-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .pdf-viewer {
            background: var(--surface-color);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 600px;
        }

        .pdf-canvas {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            cursor: text;
        }

        .pdf-navigation {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            background: var(--surface-color);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }


        .page-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: var(--background-color);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

    
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            color: white;
        }

        .loading-content {
            text-align: center;
            background: var(--surface-color);
            color: var(--text-primary);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .loading-spinner {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .error-message {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
            text-align: center;
        }

       
        html {
            scroll-behavior: smooth;
        }

        .pdf-viewer {
            scroll-margin-top: 120px;
        }


        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                padding: 0 1rem;
            }

            .reader-container {
                flex-direction: column;
                padding: 1rem;
            }

            .pdf-viewer {
                padding: 1rem;
            }

            .pdf-navigation {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .nav-btn {
                min-width: auto;
                padding: 12px 20px;
            }

            .button-control {
                padding: 12px 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="loading-spinner">
                <i class="fas fa-spinner fa-spin" style="color: #5a0010"></i>
            </div>
            <h3>Memuat PDF...</h3>
            <p class="text-muted">Harap tunggu sementara kami menyiapkan dokumen Anda</p>
            <div id="loadingProgress" style="margin-top: 1rem; font-size: 0.9rem; color: var(--text-secondary);"></div>
        </div>
    </div>

    <!-- Reader Header -->
    <div class="reader-header">
        <div class="header-content">
            <div class="book-info">
                <h1>{{ $book->title }}</h1>
                <p class="author">{{ $book->author ? $book->author->nama : 'Unknown Author' }}</p>
            </div>

            <div class="header-controls">
                <div class="control-group">
                    <label style="margin: 0; font-size: 0.8rem;">Zoom:</label>
                    <button class="button-control small" id="zoomOut" title="Zoom Out">
                        <i class="fas fa-search-minus"></i>
                    </button>
                    <select class="zoom-control" id="zoomSelect">
                        <option value="0.5">50%</option>
                        <option value="0.75">75%</option>
                        <option value="1" selected>100%</option>
                        <option value="1.25">125%</option>
                        <option value="1.5">150%</option>
                        <option value="2">200%</option>
                        <option value="fit">Fit Width</option>
                    </select>
                    <button class="button-control small" id="zoomIn" title="Zoom In">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>

                <a href="/library" class="cta-button" title="Back to Library">
                    Perpustakaan
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Reader Container -->
    <div class="reader-container">
        <!-- PDF Section -->
        <div class="pdf-section">
            <!-- PDF Viewer -->
            <div class="pdf-viewer">
                <div id="errorMessage" class="error-message" style="display: none;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div id="errorText">Failed to load PDF</div>
                    <button onclick="retryLoading()" class="cta-button mt-2">
                        <i class="fas fa-redo"></i> Ulangi
                    </button>
                </div>
                <canvas id="pdfCanvas" class="pdf-canvas"></canvas>
            </div>

            <!-- PDF Navigation -->
            <div class="pdf-navigation">
                <button class="cta-button" id="prevPage" title="Previous Page">
                    <i class="fas fa-chevron-left"></i>
                    Sebelumnya
                </button>

                <div class="page-info">
                    <span>Halaman</span>
                    <input type="number" class="page-input" id="pageInput" min="1" value="1">
                    <span id="pageCount">/ 1</span>
                </div>

                <button class="cta-button" id="nextPage" title="Next Page">
                    Selanjutnya
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        // PDF.js configuration
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        // Global variables
        let pdfDoc = null;
        let pageNum = 1;
        let pageRendering = false;
        let pageNumPending = null;
        let scale = 1;
        const canvas = document.getElementById('pdfCanvas');
        const ctx = canvas.getContext('2d');
        let loadingAttempts = 0;
        const maxAttempts = 3;

        // PDF loading with better error handling and timeout
        async function loadPDF() {
            const progressEl = document.getElementById('loadingProgress');

            try {
                loadingAttempts++;
                progressEl.textContent = `Loading attempt ${loadingAttempts}/${maxAttempts}...`;

                // Add timeout to prevent infinite loading
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 30000); // 30 second timeout

                const loadingTask = pdfjsLib.getDocument({
                    url: '{{ route("reader.pdf", $book->id) }}',
                    cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
                    cMapPacked: true,
                    disableAutoFetch: false,
                    disableStream: false,
                    disableRange: false,
                    httpHeaders: {
                        'Accept': 'application/pdf',
                    }
                });

                // Progress callback
                loadingTask.onProgress = function (progress) {
                    if (progress.total > 0) {
                        const percent = Math.round((progress.loaded / progress.total) * 100);
                        progressEl.textContent = `Loading... ${percent}%`;
                    }
                };

                clearTimeout(timeoutId);
                pdfDoc = await loadingTask.promise;

                console.log('PDF loaded successfully:', pdfDoc.numPages, 'pages');
                document.getElementById('pageCount').textContent = '/ ' + pdfDoc.numPages;

                await renderPage(pageNum);
                hideLoading();
                updateNavigationButtons();

            } catch (error) {
                console.error('Error loading PDF (attempt ' + loadingAttempts + '):', error);

                if (loadingAttempts < maxAttempts) {
                    progressEl.textContent = `Retrying in 2 seconds... (${loadingAttempts}/${maxAttempts})`;
                    setTimeout(() => loadPDF(), 2000);
                    return;
                }

                hideLoading();
                showError('Failed to load PDF: ' + (error.message || 'Unknown error'));
            }
        }

        function retryLoading() {
            document.getElementById('errorMessage').style.display = 'none';
            document.getElementById('loadingOverlay').style.display = 'flex';
            loadingAttempts = 0;
            loadPDF();
        }

        function showError(message) {
            const errorEl = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            errorText.textContent = message;
            errorEl.style.display = 'block';
        }

        function hideLoading() {
            const overlay = document.getElementById('loadingOverlay');
            overlay.style.opacity = '0';
            setTimeout(() => {
                overlay.style.display = 'none';
            }, 300);
        }

        async function renderPage(num) {
            if (!pdfDoc || pageRendering) return;

            pageRendering = true;

            try {
                const page = await pdfDoc.getPage(num);
                let viewport;

                if (document.getElementById('zoomSelect').value === 'fit') {
                    const container = document.querySelector('.pdf-viewer');
                    const containerWidth = container.clientWidth - 80;
                    viewport = page.getViewport({ scale: 1 });
                    scale = containerWidth / viewport.width;
                    viewport = page.getViewport({ scale: scale });
                } else {
                    viewport = page.getViewport({ scale: scale });
                }

                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                await page.render(renderContext).promise;
                pageRendering = false;

                if (pageNumPending !== null) {
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }

                document.getElementById('pageInput').value = num;
                updateNavigationButtons();

                // Auto scroll to top of PDF viewer after page change
                scrollToTop();

            } catch (error) {
                console.error('Error rendering page:', error);
                pageRendering = false;
                showError('Error rendering page: ' + error.message);
            }
        }

        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prevPage');
            const nextBtn = document.getElementById('nextPage');

            prevBtn.disabled = pageNum <= 1;
            nextBtn.disabled = !pdfDoc || pageNum >= pdfDoc.numPages;
        }

        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        function onPrevPage() {
            if (pageNum <= 1) return;
            pageNum--;
            queueRenderPage(pageNum);
        }

        function onNextPage() {
            if (!pdfDoc || pageNum >= pdfDoc.numPages) return;
            pageNum++;
            queueRenderPage(pageNum);
        }

        function goToPage(page) {
            if (!pdfDoc || page < 1 || page > pdfDoc.numPages) return;
            pageNum = page;
            queueRenderPage(pageNum);
        }

        function changeZoom(newScale) {
            if (newScale === 'fit') {
                queueRenderPage(pageNum);
            } else {
                scale = parseFloat(newScale);
                queueRenderPage(pageNum);
            }
        }

        // Function to smoothly scroll to top of PDF viewer
        function scrollToTop() {
            const pdfViewer = document.querySelector('.pdf-viewer');
            if (pdfViewer) {
                // Smooth scroll to the PDF viewer
                pdfViewer.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Also scroll to top of page as fallback
                setTimeout(() => {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }, 100);
            }
        }

        // Event listeners
        document.getElementById('prevPage').addEventListener('click', onPrevPage);
        document.getElementById('nextPage').addEventListener('click', onNextPage);

        document.getElementById('pageInput').addEventListener('change', function () {
            const page = parseInt(this.value);
            if (!isNaN(page)) {
                goToPage(page);
            }
        });

        document.getElementById('pageInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                const page = parseInt(this.value);
                if (!isNaN(page)) {
                    goToPage(page);
                }
            }
        });

        document.getElementById('zoomOut').addEventListener('click', function () {
            const currentZoom = document.getElementById('zoomSelect').value;
            if (currentZoom !== 'fit') {
                const currentScale = parseFloat(currentZoom);
                if (currentScale > 0.5) {
                    const newScale = Math.max(0.5, currentScale - 0.25);
                    document.getElementById('zoomSelect').value = newScale;
                    scale = newScale;
                    queueRenderPage(pageNum);
                }
            }
        });

        document.getElementById('zoomIn').addEventListener('click', function () {
            const currentZoom = document.getElementById('zoomSelect').value;
            if (currentZoom !== 'fit') {
                const currentScale = parseFloat(currentZoom);
                if (currentScale < 3) {
                    const newScale = Math.min(3, currentScale + 0.25);
                    document.getElementById('zoomSelect').value = newScale;
                    scale = newScale;
                    queueRenderPage(pageNum);
                }
            }
        });

        document.getElementById('zoomSelect').addEventListener('change', function () {
            changeZoom(this.value);
        });

        document.addEventListener('keydown', function (e) {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
                return;
            }

            switch (e.key) {
                case 'ArrowLeft':
                case 'PageUp':
                    onPrevPage();
                    e.preventDefault();
                    break;
                case 'ArrowRight':
                case 'PageDown':
                case ' ':
                    onNextPage();
                    e.preventDefault();
                    break;
                case '+':
                case '=':
                    document.getElementById('zoomIn').click();
                    e.preventDefault();
                    break;
                case '-':
                    document.getElementById('zoomOut').click();
                    e.preventDefault();
                    break;
                case 'Home':
                    goToPage(1);
                    e.preventDefault();
                    break;
                case 'End':
                    if (pdfDoc) {
                        goToPage(pdfDoc.numPages);
                    }
                    e.preventDefault();
                    break;
            }
        });

        let resizeTimeout;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                if (document.getElementById('zoomSelect').value === 'fit') {
                    queueRenderPage(pageNum);
                }
            }, 250);
        });

        function showMessage(message, type) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 8px;
                box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
                z-index: 10000;
                animation: slideIn 0.3s ease-out;
            `;

            notification.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
                ${message}
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);

        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM loaded, starting PDF load...');
            loadPDF();
        });

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            console.log('Document already ready, starting PDF load...');
            loadPDF();
        }
    </script>
</body>

</html>