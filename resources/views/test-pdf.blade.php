<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Test - Readora</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .pdf-viewer {
            text-align: center;
            margin-top: 20px;
        }
        canvas {
            border: 1px solid #ddd;
            margin: 10px 0;
        }
        .controls {
            margin: 20px 0;
        }
        button {
            padding: 10px 20px;
            margin: 0 5px;
            background: #710014;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #5a0010;
        }
        .info {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PDF Test - Readora</h1>
        
        <div class="info">
            <h3>Testing PDF Display</h3>
            <p>This page tests if the PDF files can be properly loaded and displayed.</p>
            <p><strong>PDF File:</strong> Tere_Liye_Bumi.pdf</p>
            <p><strong>File Size:</strong> ~1.6MB</p>
        </div>

        <div class="controls">
            <button onclick="loadPdf()">Load PDF</button>
            <button onclick="prevPage()">Previous</button>
            <span id="pageInfo">Page 1 of 1</span>
            <button onclick="nextPage()">Next</button>
        </div>

        <div class="pdf-viewer">
            <canvas id="pdfCanvas"></canvas>
            <div id="loadingMsg">Click "Load PDF" to display the PDF content</div>
        </div>
    </div>

    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
        
        let pdfDoc = null;
        let pageNum = 1;
        let scale = 1.5;
        let canvas = document.getElementById('pdfCanvas');
        let ctx = canvas.getContext('2d');

        function loadPdf() {
            document.getElementById('loadingMsg').textContent = 'Loading PDF...';
            
            const loadingTask = pdfjsLib.getDocument('/test-pdf');
            loadingTask.promise.then(function(pdf) {
                pdfDoc = pdf;
                document.getElementById('pageInfo').textContent = `Page ${pageNum} of ${pdf.numPages}`;
                renderPage(pageNum);
                document.getElementById('loadingMsg').textContent = 'PDF loaded successfully!';
            }).catch(function(error) {
                console.error('Error loading PDF:', error);
                document.getElementById('loadingMsg').textContent = 'Error loading PDF: ' + error.message;
            });
        }

        function renderPage(num) {
            if (!pdfDoc) return;
            
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({scale: scale});
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                page.render(renderContext);
                document.getElementById('pageInfo').textContent = `Page ${num} of ${pdfDoc.numPages}`;
            });
        }

        function prevPage() {
            if (pageNum <= 1) return;
            pageNum--;
            renderPage(pageNum);
        }

        function nextPage() {
            if (!pdfDoc || pageNum >= pdfDoc.numPages) return;
            pageNum++;
            renderPage(pageNum);
        }
    </script>
</body>
</html>
