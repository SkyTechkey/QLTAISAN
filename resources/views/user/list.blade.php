


@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <p>trang list user</p>
        @can('create_user', App\Models\User::class)
        <a href="{{route('user.create')}}"><button>create user</button> /</a>
        @endcan
        @can('update_user', App\Models\User::class)
        <a href="/user/1/edit"><button>edit user</button> /</a>
        @endcan
        @can('delete_user', App\Models\User::class)
        <a href="{{route('user.destroy',['user'=>1])}}"><button>delete user</button> /</a>
        @endcan
        @can('change_role', App\Models\User::class)
        <a href="{{route('user.change_role')}}"><button>change role</button> /</a>
        @endcan
    </div>
</div>
@endsection

