@extends('laramanager::layouts.master')

@section('body-class')
    auth background-gradient-primary uk-height-viewport
@endsection

@section('content')
    <div class="uk-container uk-padding uk-text-center uk-width-1-1 uk-width-1-3@s uk-position-center">

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

        <div class="uk-light uk-margin">LaraManager by <a href="http://philsquare.com" class="uk-link-muted">Philsquare</a></div>

    </div>
@endsection