@extends('laramanager::layouts.sub.default')

@section('page-content')

    @yield('table')

@endsection

@push('scripts-last')
    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    @yield('table-settings')
@endpush