<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Fixed Sidebar</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- IonIcons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- uPlot -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/uplot/uPlot.min.css') }}>
    <!-- daterange picker -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/daterangepicker/daterangepicker.css') }}>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
    href={{ URL::asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
    href={{ URL::asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}>
    <!-- Select2 -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/select2/css/select2.min.css') }}>
    <link rel="stylesheet"
    href={{ URL::asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}>
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet"
    href={{ URL::asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}>
    <!-- BS Stepper -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/bs-stepper/css/bs-stepper.min.css') }}>
    <!-- dropzonejs -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/dropzone/min/dropzone.min.css') }}>
    <!-- CodeMirror -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/codemirror/codemirror.css') }}>
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/codemirror/theme/monokai.css') }}>
    <!-- SimpleMDE -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/simplemde/simplemde.min.css') }}>
    <!-- summernote -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/summernote/summernote-bs4.min.css') }}>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href={{ URL::asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    
     <!-- DataTables -->
  <link rel="stylesheet" href={{ URL::asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ URL::asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}>
  <link rel="stylesheet" href={{ URL::asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}>
  <!-- jsGrid -->
  <link rel="stylesheet" href={{ URL::asset('assets/plugins/jsgrid/jsgrid.min.css') }}>
  <link rel="stylesheet" href={{ URL::asset('assets/plugins/jsgrid/jsgrid-theme.min.css') }}>
    
    
    
    <!-- Theme style -->
    <link rel="stylesheet" href={{ URL::asset('assets/dist/css/adminlte.css') }}>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
    @show
    @include('layouts.nav')
    @include('layouts.sidebar')
    @yield('content')
    @include('layouts.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src={{ URL::asset('assets/plugins/jquery/jquery.min.js') }}></script>
<!-- Bootstrap 4 -->
<script src={{ URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<!-- overlayScrollbars -->
<script src={{ URL::asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}></script>
<!-- OPTIONAL SCRIPTS -->
<script src={{ URL::asset('assets/plugins/chart.js/Chart.min.js') }}></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src={{ URL::asset('assets/dist/js/pages/dashboard3.js') }}></script>
<!-- FLOT CHARTS -->
<script src={{ URL::asset('assets/plugins/flot/jquery.flot.js') }}></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src={{ URL::asset('assets/plugins/flot/plugins/jquery.flot.resize.js') }}></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src={{ URL::asset('assets/plugins/flot/plugins/jquery.flot.pie.js') }}></script>
<!-- jQuery Knob -->
<script src={{ URL::asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}></script>
<!-- Sparkline -->
<script src={{ URL::asset('assets/plugins/sparklines/sparkline.js') }}></script>
<!-- uPlot -->
<script src={{ URL::asset('assets/plugins/uplot/uPlot.iife.min.js') }}></script>
<!-- Select2 -->
<script src={{ URL::asset('assets/plugins/select2/js/select2.full.min.js') }}></script>
<!-- Bootstrap4 Duallistbox -->
<script src={{ URL::asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}></script>
<!-- InputMask -->
<script src={{ URL::asset('assets/plugins/moment/moment.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}></script>
<!-- date-range-picker -->
<script src={{ URL::asset('assets/plugins/daterangepicker/daterangepicker.js') }}></script>
<!-- bootstrap color picker -->
<script src={{ URL::asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src={{ URL::asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}>
</script>
<!-- Bootstrap Switch -->
<script src={{ URL::asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}></script>
<!-- BS-Stepper -->
<script src={{ URL::asset('assets/plugins/bs-stepper/js/bs-stepper.min.js') }}></script>
<!-- dropzonejs -->
<script src={{ URL::asset('assets/plugins/dropzone/min/dropzone.min.js') }}></script>
<!-- Summernote -->
<script src={{ URL::asset('assets/plugins/summernote/summernote-bs4.min.js') }}></script>
<!-- CodeMirror -->
<script src={{ URL::asset('assets/plugins/codemirror/codemirror.js') }}></script>
<script src={{ URL::asset('assets/plugins/codemirror/mode/css/css.js') }}></script>
<script src={{ URL::asset('assets/plugins/codemirror/mode/xml/xml.js') }}></script>
<script src={{ URL::asset('assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}></script>
<!-- bs-custom-file-input -->
<script src={{ URL::asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}></script>
<!-- jquery-validation -->
<script src={{ URL::asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/jquery-validation/additional-methods.min.js') }}></script>
<!-- DataTables  & Plugins -->
<script src={{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/jszip/jszip.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/pdfmake/pdfmake.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/pdfmake/vfs_fonts.js') }}></script>
<script src={{ URL::asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}></script>
<script src={{ URL::asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}></script>
<!-- jsGrid -->
<script src={{ URL::asset('assets/plugins/jsgrid/demos/db.js') }}></script>
<script src={{ URL::asset('assets/plugins/jsgrid/jsgrid.min.js') }}></script>






<!-- AdminLTE App -->
<script src={{ URL::asset('assets/dist/js/adminlte.min.js') }}></script>
<!-- AdminLTE for demo purposes -->
<script src={{ URL::asset('assets/dist/js/demo.js') }}></script>
<script src={{ URL::asset('assets/dist/js/charts.js') }}></script>
<script src={{ URL::asset('assets/dist/js/form.js') }}></script>
<script src={{ URL::asset('assets/dist/js/mailbox.js') }}></script>
<script src={{ URL::asset('assets/dist/js/tables.js') }}></script>
<script src={{ URL::asset('assets/dist/js/main.js') }}></script>
</body>

</html>
