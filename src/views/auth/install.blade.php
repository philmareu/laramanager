@extends('laramanager::layouts.auth')

@section('title')
    Install
@endsection

@section('content')

    <div class="uk-width-medium-1-5 uk-vertical-align-middle">
        <div id="login-box">
            <div class="title-bar"><span uk-icon="icon: sign-in;" class="uk-margin-small-right"></span>{{ config('laramanager.site_title') }} Create Admin</div>
            <form class="uk-form uk-text-left" method="POST" action="{{ url('laramanager/install') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <span class="errors uk-text-danger">{{ $errors->first('name') }}</span>
                        <div class="uk-form-icon uk-form-controls">
                            need to updated
                            <input type="text" placeholder="Name" name="name" class="uk-form-width-large" value="{{ old('name') }}">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <span class="errors uk-text-danger">{{ $errors->first('email') }}</span>
                        <div class="uk-form-icon uk-form-controls">
                            <input type="text" placeholder="Email" name="email" class="uk-form-width-large" value="{{ old('email') }}">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <span class="errors uk-text-danger">{{ $errors->first('password') }}</span>
                        <div class="uk-form-icon uk-form-controls">
                            <input type="password" placeholder="Password" name="password" class="uk-form-width-large">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <span class="errors uk-text-danger">{{ $errors->first('password_confirmation') }}</span>
                        <div class="uk-form-icon uk-form-controls">
                            <input type="password" placeholder="Confirm password" name="password_confirmation" class="uk-form-width-large">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <button type="submit" class="uk-button uk-button-primary">Create User</button>
                </div>
            </form>
        </div>
        <p class="uk-text-center">LaraManager by <a href="http://philsquare.com">Philsquare</a></p>
    </div>

@endsection