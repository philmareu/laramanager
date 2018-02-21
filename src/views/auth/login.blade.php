@extends('laramanager::layouts.sub.auth')

@section('title')
    Login
@endsection

@section('page-content')

    <form class="uk-form uk-form-stacked uk-text-left" role="form" method="POST" action="{{ url('admin/login') }}">
        {{ csrf_field() }}

        <div class="uk-text-danger">
            {{ $errors->first('email') }}
        </div>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: mail"></span>
            <input class="uk-input" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        </div>

        <div class="uk-margin">
            <div class="uk-text-danger">
                {{ $errors->first('password') }}
            </div>
            <div class="uk-inline uk-width-1-1">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input class="uk-input" type="password" name="password" placeholder="Password">
            </div>
        </div>

        <div class="uk-margin uk-dark">
            <label for="remember" class="uk-form-label">
                <input id="remember" type="checkbox" value="1" name="remember" class="uk-checkbox"> Keep me signed in
            </label>
        </div>

        <button class="uk-button uk-button-primary uk-width-1-1" type="submit">Sign In</button>

        <p class="uk-text-center"><a href="{{ url('admin/password/email') }}" class="">Forgot Password</a></p>

    </form>

@endsection