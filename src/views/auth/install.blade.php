@extends('laramanager::layouts.sub.auth')

@section('title')
    Install
@endsection

@section('page-content')

    <div class="uk-container uk-padding uk-text-center uk-width-1-1 uk-width-1-3@s">

        <div class="title uk-margin">
            <p class="uk-text-center">LaraManager by <a href="http://philsquare.com">Philsquare</a></p>
        </div>

        @if(session()->has('success'))
            <div class="uk-alert uk-alert-success" data-uk-alert>
                <a href="#" class="uk-alert-close uk-close"></a>
                {{ session('success') }}
            </div>
        @elseif(session()->has('failed'))
            <div class="uk-alert uk-alert-danger" data-uk-alert>
                <a href="#" class="uk-alert-close uk-close"></a>
                {{ session('failed') }}
            </div>
        @endif

        <div class="uk-card uk-card-default uk-card-small">

            <div class="uk-card-header uk-text-left">
                <h3 class="uk-card-title">Install</h3>
            </div>

            <div class="uk-card-body">

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
            </div>
        </div>
    </div>

@endsection
