@extends('laramanager::layouts.master')

@section('content')

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
                <h3 class="uk-card-title">@yield('title')</h3>
            </div>

            <div class="uk-card-body">

                @yield('page-content')

            </div>

        </div>

    </div>
@endsection