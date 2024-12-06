<footer id="footer" class="footer">

<!-- jQuery -->

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/colreorder/2.0.4/js/dataTables.colReorder.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.js"></script>
  <!-- <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script> -->
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
     

<script>
 AOS.init();

 const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');
const tabs = document.querySelectorAll('.nav-link');

prevButton.addEventListener('click', () => {
  const activeTab = document.querySelector('.nav-link.active');
  if (activeTab) {
    const prevTab = activeTab.parentElement.previousElementSibling;
    if (prevTab) {
      prevTab.querySelector('.nav-link').click();
    }
  }

  // Change class for buttons
});

nextButton.addEventListener('click', () => {
  const activeTab = document.querySelector('.nav-link.active');
  if (activeTab) {
    const nextTab = activeTab.parentElement.nextElementSibling;
    if (nextTab) {
      nextTab.querySelector('.nav-link').click();
    }
  }

});

tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    const activeTab = document.querySelector('.nav-link.active');
    if (activeTab) {
      activeTab.classList.remove('active');
    }
    tab.classList.add('active');
  });
});
</script>
   