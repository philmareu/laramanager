@extends('laramanager::layouts.master')

@section('content')
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-1-6 uk-visible@s">
            <div class="uk-height-1-1 background-gradient-primary" id="sidebar" uk-sticky>
                @include('laramanager::navigations.primary.index')
            </div>
        </div>
        <div class="uk-width-1-1 uk-width-5-6@s" id="primary-content-area">

            @include('laramanager::navigations.top.index')

            <div class="title-bar uk-container">
                <div class="uk-grid uk-grid-collapse uk-flex-middle">
                    <div class="uk-width-1-2">
                        <span class="title">@yield('title')</span>
                    </div>
                    <div class="uk-width-1-2">
                        @yield('actions')
                    </div>
                </div>
            </div>

            <div class="uk-container" id="secondary-content-area">
                @include('laramanager::partials.alerts.default')

                @yield('page-content')
            </div>
        </div>
    </div>
@endsection