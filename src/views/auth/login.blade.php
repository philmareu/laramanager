@extends('laramanager::layouts.auth')

@section('title')
    Login
@endsection

@section('content')

    <div class="uk-width-medium-1-5 uk-vertical-align-middle">
        <div id="login-box">
            <div class="title-bar"><i class="uk-icon-sign-in"></i> {{ config('laramanager.site_title') }} Admin</div>
            <form class="uk-form uk-text-left" method="POST" action="{{ url('admin/auth/login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <span class="errors uk-text-danger">{{ $errors->first('email') }}</span>
                        <div class="uk-form-icon uk-form-controls">
                            <i class="uk-icon-envelope"></i>
                            <input type="text" placeholder="Email" name="email" class="uk-form-width-large" value="{{ old('email') }}">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <div class="uk-form-controls">
                        <span class="errors uk-text-danger">{{ $errors->first('password') }}</span>
                        <div class="uk-form-icon uk-form-controls">
                            <i class="uk-icon-lock"></i>
                            <input type="password" placeholder="Password" name="password" class="uk-form-width-large">
                        </div>
                    </div>
                </div>

                <div class="uk-form-row">
                    <input type="checkbox" value="1"> Remember
                </div>

                <div class="uk-form-row">
                    <div class="uk-grid uk-grid-collapse uk-flex-middle">
                        <div class="uk-width-medium-1-2">
                            <button type="submit" class="uk-button uk-button-primary">Login</button>
                        </div>
                        <div class="uk-width-medium-1-2">
                            <a href="{{ url('admin/auth/password/email') }}" class="forgot-password">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <p class="uk-text-center">LaraManager by <a href="http://philsquare.com">Philsquare</a></p>
    </div>

@endsection