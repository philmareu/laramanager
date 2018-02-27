@extends('laramanager::layouts.master')

@section('content')
    <div class="uk-grid uk-grid-collapse">
        <div class="uk-width-1-6 uk-visible@s">
            <div class="uk-height-1-1 background-gradient-primary" id="sidebar" uk-sticky>
                @include('laramanager::navigations.primary.index')
            </div>
        </div>
        <div class="uk-width-1-1 uk-width-5-6@s" id="primary-content-area">

            <div class="uk-card uk-card-default uk-card-small uk-card-body uk-margin-medium">
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
                @yield('blank-content')
            </div>
        </div>
    </div>
@endsection