{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in! /
                    @can('is-admin', App\Models\User::class)
                    <a href="{{route('admin')}}">admin page /</a>
                    @endcan

                    @can('view_content', App\Models\User::class)
                    <a href="{{route('content.index')}}">Post list /</a>
                    @endcan
                    @can('create_content', App\Models\User::class)
                    <a href="{{route('content.create')}}">create page content /</a>
                    @endcan
                    @can('update_content', App\Models\User::class)
                    <a href="{{route('content.edit',['content'=>1])}}">upadate page content /</a>
                    @endcan
                    @can('delete_content', App\Models\User::class)
                    <a href="{{route('content.destroy',['content'=>1])}}">delete page content /</a>
                    @endcan

                    @can('view_user', App\Models\User::class)
                    <a href="{{route('user.index')}}">users list /</a>
                    @endcan
                    @can('create_user', App\Models\User::class)
                    <a href="{{route('user.create')}}">create page user /</a>
                    @endcan
                    @can('update_user', App\Models\User::class)
                    <a href="/user/1/edit">upadate page user /</a>
                    @endcan
                    @can('delete_user', App\Models\User::class)
                    <a href="{{route('user.destroy',['user'=>1])}}">delete page user /</a>
                    @endcan
                    {{-- @can('change_role', App\Models\User::class)
                    <a href="{{route('user.change_role')}}">change page user /</a>
                    @endcan --}}
                {{-- </div>
                
            </div>
        </div>
    </div> --}}

@extends('layouts.index')
@section('content')
<div class="container">
    <div class="row">
    </div>
</div>
@endsection

