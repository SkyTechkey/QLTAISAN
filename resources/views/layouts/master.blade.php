
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> @yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::asset ('/plugins/fontawesome-free/css/all.min.css'); }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset ('/dist/css/adminlte.min.css'); }}">
    
    {{-- @stack('style-up') --}}
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
        <!--Main Header-->
        @include('partials.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('partials.left-sidebar')
    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div>
        <!--Main Footer-->
        @include('partials.footer')
    </div>
    @stack('js-up')
</body>
</html>