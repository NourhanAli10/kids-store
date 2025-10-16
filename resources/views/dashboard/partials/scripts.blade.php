
 <!-- plugins:js -->
 <script src="{{ asset('dashboard_assets/vendors/js/vendor.bundle.base.js') }}"></script>
 <!-- endinject -->
 <!-- Plugin js for this page -->
 <script src="{{ asset('dashboard_assets/vendors/chart.js/Chart.min.js') }}"></script>
 <script src="{{ asset('dashboard_assets/vendors/jquery-circle-progress/js/circle-progress.min.js') }}"></script>
 <script src="{{ asset('dashboard_assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
 <!-- End plugin js for this page -->
 <!-- inject:js -->
 <script src="{{ asset('dashboard_assets/js/off-canvas.js') }}"></script>
 <script src="{{ asset('dashboard_assets/js/hoverable-collapse.js') }}"></script>
 <script src="{{ asset('dashboard_assets/js/misc.js') }}"></script>
 <!-- endinject -->
 <!-- Custom js for this page -->
 <script src="{{ asset('dashboard_assets/js/dashboard.js') }}"></script>
 <!-- End custom js for this page -->

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('js')
