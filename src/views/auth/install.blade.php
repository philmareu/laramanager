@extends('laramanager::layouts.admin.auth')

@section('title')
    Install
@endsection

@section('auth-content')

    <form class="uk-form uk-form-stacked uk-text-left" role="form" method="POST" action="{{ url('laramanager/install') }}">
        {{ csrf_field() }}

        <div class="uk-text-danger">
            {{ $errors->first('name') }}
        </div>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="text" name="name" placeholder="Name" value="{{ old('name') }}">
        </div>

        <div class="uk-margin">
            <div class="uk-text-danger">
                {{ $errors->first('email') }}
            </div>
            <div class="uk-inline uk-width-1-1">
                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                <input class="uk-input" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
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

        <div class="uk-margin">
            <div class="uk-text-danger">
                {{ $errors->first('password_confirmation') }}
            </div>
            <div class="uk-inline uk-width-1-1">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input class="uk-input" type="password" name="password_confirmation" placeholder="Confirm password">
            </div>
        </div>

        <button class="uk-button uk-button-primary uk-width-1-1" type="submit">Install</button>

    </form>

@endsection
