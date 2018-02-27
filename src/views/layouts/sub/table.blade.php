@extends('laramanager::layouts.sub.default')

@section('page-content')

    <div class="uk-card uk-card-small uk-card-default">
        <div class="uk-card-header">
            <h3 class="uk-card-title">@yield('table-name')</h3>
        </div>
        <div class="uk-card-body">
            @yield('table')
        </div>
    </div>

@endsection

@push('scripts-last')
    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    @yield('table-settings')
@endpush