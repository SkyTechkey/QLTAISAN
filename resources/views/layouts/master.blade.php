
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> @yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    @include('partials.style-up') {{-- CSS dùng chung cho cả hệ thống --}}
    @include('partials.script-up') {{-- script dùng chung cho cả hệ thống --}}
    @stack('css-up'){{-- CSS dùng riêng cho từng layout--}}
    @stack('js-up'){{-- JS dùng riêng cho từng layout--}}
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

    @include('partials.style-down') {{-- CSS dùng chung cho cả hệ thống --}}
    @include('partials.script-down') {{-- script dùng chung cho cả hệ thống --}}
    @stack('css-down'){{-- CSS dùng riêng cho từng layout--}}
    @stack('js-down'){{-- JS dùng riêng cho từng layout--}}
</body>
</html>
