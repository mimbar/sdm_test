@extends('home::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('home.name') !!}
        <a href="{{ route('home.acl') }}">ACL</a>
        <a href="{{ route('home.users') }}">Users</a>
        <a href="{{ route('home.profile') }}">Profile</a>
         | <a href="{{ route('auth.logout') }}">Logout</a>


    </p>
@stop
