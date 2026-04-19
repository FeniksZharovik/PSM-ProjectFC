@extends('layouts.app')

@section('content')
    <section class="pt-28 pb-20 bg-gradient-to-r from-blue-950 to-blue-700 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-bold">
            {{ $magazine->title }}
        </h1>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <div class="bg-gray-100 p-4 rounded shadow">
                <canvas id="pdf-canvas" class="mx-auto"></canvas>
            </div>

            <div class="flex justify-center mt-6 gap-4">
                <button id="prev" class="px-4 py-2 bg-blue-700 text-white rounded">Prev</button>
                <span>Page: <span id="page-num"></span> / <span id="page-count"></span></span>
                <button id="next" class="px-4 py-2 bg-blue-700 text-white rounded">Next</button>
            </div>

        </div>
    </section>

    {{-- PDF.js CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

    <script>
        const url = "{{ route('majalah.preview', $magazine->id) }}";

        pdfjsLib.GlobalWorkerOptions.workerSrc =
            'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        let pdfDoc = null,
            pageNum = 1,
            scale = 1.8,
            canvas = document.getElementById('pdf-canvas'),
            ctx = canvas.getContext('2d');

        async function loadPDF() {
            // 🔥 FETCH AS BLOB (ANTI IDM)
            const response = await fetch(url);
            const blob = await response.blob();
            const arrayBuffer = await blob.arrayBuffer();

            const loadingTask = pdfjsLib.getDocument({
                data: arrayBuffer
            });

            loadingTask.promise.then(function(pdf) {
                pdfDoc = pdf;
                document.getElementById('page-count').textContent = pdf.numPages;
                renderPage(pageNum);
            });
        }

        function renderPage(num) {
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({
                    scale: scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                page.render({
                    canvasContext: ctx,
                    viewport: viewport
                });

                document.getElementById('page-num').textContent = num;
            });
        }

        document.getElementById('prev').onclick = () => {
            if (pageNum <= 1) return;
            pageNum--;
            renderPage(pageNum);
        };

        document.getElementById('next').onclick = () => {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            renderPage(pageNum);
        };

        loadPDF();
    </script>
@endsection
