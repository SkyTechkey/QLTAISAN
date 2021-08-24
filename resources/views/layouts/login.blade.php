
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> @yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
   @stack('css-login') 
</head>

<body >
    <div class="container">
        @yield('content')
    </div>
    @stack('js-login')
</body>
</html>