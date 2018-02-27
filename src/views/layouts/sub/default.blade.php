@extends('laramanager::layouts.sub.blank')

@section('blank-content')
    <div class="uk-card uk-card-default uk-card-small">
        <div class="uk-card-header">
            <h3 class="uk-card-title">@yield('title')</h3>
        </div>

        <div class="uk-card-body">
            @yield('default-content')
        </div>
    </div>
@endsection