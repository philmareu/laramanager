@extends('laramanager::layouts.auth')

@section('title')
    {{ config('laramanager.site_title') }} | Login
@endsection

@section('content')
    @include('laraform::auth.login.admin', ['action' => url('admin/auth/login')])
@endsection