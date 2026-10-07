<?php
/* Template Name: PDF Viewer */
get_header();

$file = isset($_GET['file']) ? urldecode($_GET['file']) : '';
?>

<div class="section-content relative">
  <div class="row align-center">
		<div class="col small-12 large-12">
	<div class="col-inner text-center">			
	<div id="pdf-container">
    <p>Đang tải PDF...</p>
</div>
	</div>	
</div>
  </div>
</div>






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/5.4.149/pdf_viewer.min.css">

<script type="module">
import * as pdfjsLib from 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/5.4.149/pdf.min.mjs';

// ⚠️ QUAN TRỌNG: set worker
pdfjsLib.GlobalWorkerOptions.workerSrc =
  'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/5.4.149/pdf.worker.min.mjs';

const url = "<?php echo esc_url($file); ?>";
const container = document.getElementById('pdf-container');

async function renderPDF() {
    try {
        const loadingTask = pdfjsLib.getDocument(url);
        const pdf = await loadingTask.promise;

        container.innerHTML = ""; // clear loading

        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            const page = await pdf.getPage(pageNum);

            const viewport = page.getViewport({ scale: 1 });

            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");

            // auto fit width
            const scale = container.clientWidth / viewport.width;
            const scaledViewport = page.getViewport({ scale });

            canvas.width = scaledViewport.width;
            canvas.height = scaledViewport.height;

            container.appendChild(canvas);

            await page.render({
                canvasContext: context,
                viewport: scaledViewport
            }).promise;
        }
    } catch (error) {
        container.innerHTML = "❌ Lỗi load PDF: " + error.message;
        console.error(error);
    }
}

renderPDF();
</script>

<?php get_footer(); ?>