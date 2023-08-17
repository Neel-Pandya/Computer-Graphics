  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/vertical-layout-light/style.css">

    @stack('css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      @include('partials._navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
      
            <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
      @include('partials._sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('content')
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
        

      
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ URL::to('/') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ URL::to('/') }}/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ URL::to('/') }}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ URL::to('/') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{ URL::to('/') }}/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ URL::to('/') }}/js/off-canvas.js"></script>
    <script src="{{ URL::to('/') }}/js/hoverable-collapse.js"></script>
    <script src="{{ URL::to('/') }}/js/template.js"></script>
    <script src="{{ URL::to('/') }}/js/settings.js"></script>
    <script src="{{ URL::to('/') }}/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ URL::to('/') }}/js/dashboard.js"></script>
    <script src="{{ URL::to('/') }}/js/Chart.roundedBarCharts.js"></script>

    @stack('scripts')
    <!-- End custom js for this page-->
  </body>

  </html>

