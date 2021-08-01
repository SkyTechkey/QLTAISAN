<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AdminLTE</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
      <!-- fullCalendar -->
    <link rel="stylesheet" href="/plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
    @stack('third_party_stylesheets')

    @stack('page_css')

    <style>
      .upload-area {
          max-width: 500px;
          margin: 0 auto;
      }

      .imgPreview img {
          padding: 8px;
          max-width: 100px;
      }

      .media .file-name {
          color: #000;
      }

      .media .media-item-hover:hover {
          background-color: #ccc;
          cursor: pointer;
      }

      .media>div {
          display: flex;
          flex-wrap: wrap;
          width: 100%;
      }

      .media .file-img {
          position: relative;
          top: 0;
          right: 0;
          left: 0;
          bottom: 0;
          min-height: 250px;
      }

      .media .file-img img {
          width: 100%;
          position: absolute;
          right: 0;
          bottom: 0;
          left: 0;
      }

      .box-shadow {
          box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5) !important;
      }

      .hidden {
          display: none !important;
      }

      /* .media .media-item > i{

      } */

      .app-file-list {
          position: relative;
      }
      
      .app-file-list .app-file-icon {
          background-color: #f5f5f5;
          padding: 2rem;
          height: 250px;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 2rem;
          border-bottom: 1px solid #ccc;
          border-top-right-radius: 8px;
          border-top-left-radius: 8px;
      }

      .position-absolute {
          position: absolute;
          top: 0;
          right: 0;
          margin-right: 3px;
      }

      .btn-hover {
          background-color: #fff;
          font-size: 14px;
          width: auto;
          display: inline-flex;
          font-weight: 600;
          align-items: center;
          padding: 2px 6px;
          line-height: 10px;
          margin-bottom: 3px;
          border-radius: 0.3rem;
      }

      .btn-hover:hover {
          background-color: #ccc;
      }

      .inline-block {
          display: inline-block !important;
      }

      .dropdown .dropdown-item:hover {
          background-color: #ccc;
      }

  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Preloader -->
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div> --}}
        <!--Main Header-->
        @include('layouts.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div>
        <!--Main Footer-->
        @include('layouts.footer')
    </div>
      
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
@stack('dashboard')
@stack('content')
@stack('user')
{{-- @stack('files') --}}

</body>

</html>
