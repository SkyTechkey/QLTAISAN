
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AdminLTE</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
        <!--Main Header-->
        @include('partials.header')
        @stack('css-up')
       @stack('js-up')

        <!-- Left side column. contains the logo and sidebar -->
        @include('partials.left-sidebar')

    
        <!-- Content Wrapper. Contains page content -->
        {{-- <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div> --}}
        <!--Main Footer-->
        @include('partials.footer')
    </div>
</body>
</html>