<footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="<?php echo BASE_URL; ?>assets/js/jquery-3.6.0.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/admin/js/core/popper.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/admin/js/core/bootstrap.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/admin/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/admin/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/admin/js/plugins/chartjs.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/sweetalert2.all.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/admin/js/dropzone-min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/es-ES.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/DataTables/datatables.min.js"></script>
  <script>
    const base_url = '<?php echo BASE_URL; ?>';
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?php echo BASE_URL; ?>assets/admin/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>