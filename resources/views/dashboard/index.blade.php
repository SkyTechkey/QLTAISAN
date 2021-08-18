
@extends('layouts.index')
@push('css-up')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endpush

@section('content')
    <h4 class="text-center fw-light fs-5">
    Hello {{ $LoggedUserInfo['name'] }}</h4>
    <a class="d-block text-center" href="{{ route('logout') }}">Logout</a>
@endsection