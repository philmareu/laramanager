@extends('laramanager::layouts.admin.master')

@section('content')
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-1-5@s uk-width-1-6@m  uk-visible@s">
            <div class="uk-height-1-1 background-gradient-primary" id="sidebar" uk-sticky>
                @include('laramanager::navigations.primary.index')
            </div>
        </div>
        <div class="uk-width-1-1 uk-width-4-5@s uk-width-5-6@m" id="primary-content-area">

            <nav class="uk-navbar-container uk-hidden@s" uk-navbar>
                <div class="uk-navbar-left">
                    <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="#offcanvas-navigation" uk-toggle></a>
                    <div class="uk-navbar-item">
                        <div>{{ config('app.name') }}</div>
                    </div>
                </div>
            </nav>

            <div class="uk-card uk-card-default uk-card-small uk-card-body uk-margin-medium uk-margin-remove-top">
                <div class="uk-grid uk-grid-collapse uk-flex-middle">
                    <div class="uk-width-1-2">
                        <ul class="uk-breadcrumb">
                            @yield('breadcrumbs')
                        </ul>
                    </div>
                    <div class="uk-width-1-2 uk-text-right">
                        @yield('actions')
                    </div>
                </div>
            </div>

            <div class="uk-container">
                @include('laramanager::partials.alerts.default')

                @yield('blank-content')
            </div>
        </div>
    </div>
@endsection