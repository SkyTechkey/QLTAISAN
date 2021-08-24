@extends('layouts.login')
<!-- Title content -->
@section('title')
    Login
@endsection
<!-- End Title -->

<!--Add Css -->
@push('css-login')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: #40E0D0;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #FF0080, #ec008c, #40E0D0);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #FF0080, #ec008c, #40E0D0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        .btn-login {
            width: 100%;
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }

    </style>
@endpush
<!-- End Css -->

<!-- Body content -->
@section('content')
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <h4 class="card-title text-center mb-5 fw-light fs-5">LOGIN</h4>
                    <form action="{{ route('login.check') }}" method="post">
                        @csrf
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        <div class="form-floating mb-3">
                            <label for="floatingInput">Username</label>
                            <input type="text" class="form-control" id="floatingInput"
                                placeholder="Username" name="username">
                            <span class="text-danger">@error('username'){{ $message }} @enderror</span>
                        </div>
                        <div class="form-floating mb-3">
                            <label for="floatingPassword">Password</label>
                            <input type="password" class="form-control" id="floatingPassword"
                                placeholder="Password" name="password">
                                <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                            <label class="form-check-label" for="rememberPasswordCheck">
                                Remember password
                            </label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">LOGIN</button>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <a href="#">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- End body-->
@push('js-login')
    <script src="/plugins/jquery/jquery.min.js"></script>
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endpush