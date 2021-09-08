@extends('laramanager::layouts.admin.master')

@section('body-classes')
    auth background-gradient-primary uk-height-viewport
@endsection

@section('content')
    <div class="uk-padding uk-text-center uk-position-center">

        <div class="uk-width-large">
            <div class="uk-text-large uk-margin uk-light">{{ config('app.name') }} Admin</div>

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
            @elseif(session()->has('status'))
                <div class="uk-alert uk-alert-warning" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    {{ session('status') }}
                </div>
            @endif

            <div class="uk-card uk-card-default uk-card-small">

                <div class="uk-card-header uk-text-left">
                    <h3 class="uk-card-title">@yield('title')</h3>
                </div>

                <div class="uk-card-body">

                    @yield('auth-content')

                </div>

            </div>

            <div class="uk-light uk-margin">Laramanager by <a href="https://philmareu.com" class="uk-link-muted">Phil Mareu</a></div>

        </div>

    </div>
@endsection
