<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reading: {{ $book->title }} - Readora</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js"></script>
    <style>
        :root {
            --primary-color: #710014;
            --secondary-color: #B38F6F;
            --background-color: #F2F1ED;
            --text-color: #000000;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--text-color);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        .reader-header {
            background: white;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .reader-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
            font-size: 1.2rem;
        }
        
        .reader-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .control-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-control {
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 0.5rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-control:hover {
            background: #5a0010;
            color: white;
        }
        
        .btn-control:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        
        .page-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0.25rem;
        }
        
        .zoom-control {
            width: 80px;
        }
        
        .reader-container {
            display: flex;
            height: calc(100vh - 80px);
        }
        
        .pdf-viewer {
            flex: 1;
            background: #525659;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: auto;
            padding: 2rem;
        }
        
        .pdf-canvas {
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            margin-bottom: 2rem;
            cursor: text;
        }
        
        .sidebar {
            width: 350px;
            background: white;
            border-left: 1px solid #dee2e6;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }
        
        .sidebar.collapsed {
            transform: translateX(100%);
        }
        
        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            background: #f8f9fa;
        }
        
        .sidebar-tabs {
            display: flex;
            border-bottom: 1px solid #dee2e6;
        }
        
        .sidebar-tab {
            flex: 1;
            padding: 0.75rem;
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .sidebar-tab.active {
            background: var(--primary-color);
            color: white;
        }
        
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }
        
        /* Notes and highlight styles removed */
        
        /* More notes styles removed */
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        
        .btn-primary:hover {
            background-color: #5a0010;
            border-color: #5a0010;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            color: white;
            font-size: 1.2rem;
        }
        
        .sidebar-toggle {
            position: fixed;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem 0.5rem;
            border-radius: 8px 0 0 8px;
            cursor: pointer;
            z-index: 999;
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle:hover {
            background: #5a0010;
        }
        
        /* Text selection style removed */
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: fixed;
                top: 80px;
                right: 0;
                height: calc(100vh - 80px);
                z-index: 1001;
            }
            
            .reader-controls {
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            
            .control-group {
                gap: 0.25rem;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div>
            <i class="fas fa-spinner fa-spin me-2"></i>
            Loading PDF...
        </div>
    </div>

    <!-- Reader Header -->
    <div class="reader-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h1 class="reader-title">{{ $book->title }}</h1>
                    <small class="text-muted">by {{ $book->author }}</small>
                </div>
                <div class="col-md-8">
                    <div class="reader-controls justify-content-end">
                        <div class="control-group">
                            <button class="btn-control" id="prevPage" title="Previous Page">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <input type="number" class="page-input" id="pageInput" min="1" value="1">
                            <span id="pageCount">/ 1</span>
                            <button class="btn-control" id="nextPage" title="Next Page">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                        
                        <div class="control-group">
                            <button class="btn-control" id="zoomOut" title="Zoom Out">
                                <i class="fas fa-search-minus"></i>
                            </button>
                            <select class="zoom-control form-select form-select-sm" id="zoomSelect">
                                <option value="0.5">50%</option>
                                <option value="0.75">75%</option>
                                <option value="1" selected>100%</option>
                                <option value="1.25">125%</option>
                                <option value="1.5">150%</option>
                                <option value="2">200%</option>
                                <option value="fit">Fit Width</option>
                            </select>
                            <button class="btn-control" id="zoomIn" title="Zoom In">
                                <i class="fas fa-search-plus"></i>
                            </button>
                        </div>
                        
                        <div class="control-group">
                            <a href="/library" class="btn-control" title="Back to Library">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reader Container -->
    <div class="reader-container">
        <!-- PDF Viewer -->
        <div class="pdf-viewer" id="pdfViewer" style="width: 100%;">
            <canvas id="pdfCanvas" class="pdf-canvas"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // PDF.js configuration
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
        
        // Global variables
        let pdfDoc = null;
        let pageNum = 1;
        let pageRendering = false;
        let pageNumPending = null;
        let scale = 1;
        let canvas = document.getElementById('pdfCanvas');
        let ctx = canvas.getContext('2d');
        
        // CSRF token for AJAX requests
        const csrfToken = '{{ csrf_token() }}';
        
        // Set worker source path
        pdfjsLib.GlobalWorkerOptions.workerSrc = '{{ asset("js/pdf.worker.min.js") }}';
        
        // Load PDF with correct path
        const loadingTask = pdfjsLib.getDocument('{{ route("reader.pdf", $book->id) }}');
        loadingTask.promise.then(function(pdf) {
            pdfDoc = pdf;
            document.getElementById('pageCount').textContent = '/ ' + pdf.numPages;
            renderPage(pageNum);
            hideLoading();
        }).catch(function(error) {
            console.error('Error loading PDF:', error);
            hideLoading();
            showMessage('Error loading PDF file. Path may be incorrect. Please check the file path and try again.', 'error');
        });
        
        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }
        
        function renderPage(num) {
            pageRendering = true;
            
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({scale: scale});
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                
                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                
                const renderTask = page.render(renderContext);
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });
            
            document.getElementById('pageInput').value = num;
        }
        
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }
        
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }
        
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }
        
        function goToPage(page) {
            if (page >= 1 && page <= pdfDoc.numPages) {
                pageNum = page;
                queueRenderPage(pageNum);
            }
        }
        
        function changeZoom(newScale) {
            if (newScale === 'fit') {
                const container = document.getElementById('pdfViewer');
                const containerWidth = container.clientWidth - 100; // Account for padding
                pdfDoc.getPage(pageNum).then(function(page) {
                    const viewport = page.getViewport({scale: 1});
                    scale = containerWidth / viewport.width;
                    queueRenderPage(pageNum);
                });
            } else {
                scale = parseFloat(newScale);
                queueRenderPage(pageNum);
            }
        }
        
        // Event listeners
        document.getElementById('prevPage').addEventListener('click', onPrevPage);
        document.getElementById('nextPage').addEventListener('click', onNextPage);
        
        document.getElementById('pageInput').addEventListener('change', function() {
            const page = parseInt(this.value);
            goToPage(page);
        });
        
        document.getElementById('zoomOut').addEventListener('click', function() {
            if (scale > 0.5) {
                scale -= 0.25;
                document.getElementById('zoomSelect').value = scale;
                queueRenderPage(pageNum);
            }
        });
        
        document.getElementById('zoomIn').addEventListener('click', function() {
            if (scale < 3) {
                scale += 0.25;
                document.getElementById('zoomSelect').value = scale;
                queueRenderPage(pageNum);
            }
        });
        
        document.getElementById('zoomSelect').addEventListener('change', function() {
            changeZoom(this.value);
        });
        
        // Sidebar functionality
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const icon = toggle.querySelector('i');
            
            sidebar.classList.toggle('collapsed');
            
            if (sidebar.classList.contains('collapsed')) {
                icon.className = 'fas fa-chevron-left';
            } else {
                icon.className = 'fas fa-chevron-right';
            }
        });
        
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('toggleSidebar').click();
        });
        
        // Tab switching
        document.querySelectorAll('.sidebar-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.sidebar-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                const tabType = this.dataset.tab;
                filterNotes(tabType);
            });
        });
        
        // Note functionality removed
        
        // clearNoteForm function removed
        
        // saveNote function removed
            // Note deletion code removed
        
        function showMessage(message, type) {
            // Remove existing notifications with fade out animation
            const existingNotifications = document.querySelectorAll('.toast-notification');
            existingNotifications.forEach(notification => {
                notification.classList.add('hide');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.remove();
                    }
                }, 300);
            });

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `toast-notification toast-${type === 'success' ? 'success' : 'error'}`;
            notification.innerHTML = `
                <div class="toast-content">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
                <button class="toast-close" onclick="hideNotification(this.parentElement)">
                    <i class="fas fa-times"></i>
                </button>
            `;

            // Add to page
            document.body.appendChild(notification);

            // Trigger fade in animation
            setTimeout(() => {
                notification.classList.add('show');
            }, 10);

            // Auto-hide after 3 seconds
            setTimeout(() => {
                hideNotification(notification);
            }, 3000);
        }

        function hideNotification(notification) {
            notification.classList.add('hide');
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 300);
        }
        
        // Notes list and text selection functionality removed
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
                return;
            }
            
            switch(e.key) {
                case 'ArrowLeft':
                    onPrevPage();
                    e.preventDefault();
                    break;
                case 'ArrowRight':
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
                // Note shortcut removed
            }
        });
    </script>
</body>
</html>
