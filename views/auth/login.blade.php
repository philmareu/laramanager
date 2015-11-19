@extends('laramanager::layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    @include('laraform::auth.login.admin', ['action' => url('admin/auth/login')])
@endsection