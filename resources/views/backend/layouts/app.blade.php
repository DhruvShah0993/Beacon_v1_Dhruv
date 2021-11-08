<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Beacon</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}back/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="{{ asset('/') }}back/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <!--<link rel="stylesheet" href="{{ asset('/') }}back/plugins/icheck-bootstrap/icheck-bootstrap.min.css">-->
  <link rel="stylesheet" href="{{ asset('/') }}back/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="{{ asset('/') }}back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('/') }}back/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}back/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/') }}back/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <!--<link rel="stylesheet" href="{{ asset('/') }}back/plugins/daterangepicker/daterangepicker.css">-->
  <!-- summernote -->
  <!--<link rel="stylesheet" href="{{ asset('/') }}back/plugins/summernote/summernote-bs4.min.css">-->
  <link rel="stylesheet" href="{{ asset('/') }}back/plugins/sweetalert2/sweetalert2.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    @include('backend.partials.topbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('backend.partials.left-sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    @include('backend.partials.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('/') }}back/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('/') }}back/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('/') }}back/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <!--<script src="{{ asset('/') }}back/plugins/chart.js/Chart.min.js"></script>-->
  <!-- Sparkline -->
  <!--<script src="{{ asset('/') }}back/plugins/sparklines/sparkline.js"></script>-->
  <!-- JQVMap -->
  <!--<script src="{{ asset('/') }}back/plugins/jqvmap/jquery.vmap.min.js"></script>-->
  <!--<script src="{{ asset('/') }}back/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>-->
  <!-- jQuery Knob Chart -->
  <!--<script src="{{ asset('/') }}back/plugins/jquery-knob/jquery.knob.min.js"></script>-->
  <!-- daterangepicker -->
  <!--<script src="{{ asset('/') }}back/plugins/moment/moment.min.js"></script>-->
  <!--<script src="{{ asset('/') }}back/plugins/daterangepicker/daterangepicker.js"></script>-->
  <!-- Tempusdominus Bootstrap 4 -->
  <!--<script src="{{ asset('/') }}back/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>-->
  <!-- Summernote -->
  <!--<script src="{{ asset('/') }}back/plugins/summernote/summernote-bs4.min.js"></script>-->
  <!-- overlayScrollbars -->
  <script src="{{ asset('/') }}back/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('/') }}back/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('/') }}back/dist/js/demo.js"></script>
   <script src="{{ asset('/') }}back/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('/') }}back/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('/') }}back/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ asset('/') }}back/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script><!-- comment -->
  <script src="{{ asset('/') }}back/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="{{ asset('/') }}back/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!--<script src="{{ asset('/') }}back/dist/js/pages/dashboard.js"></script>-->
  @stack('scripts')
</body>

</html>