@extends('laramanager::layouts.admin.default')

@section('default-content')

    <div class="uk-overflow-auto">
        <table id="data-table" class="stripe row-border uk-table uk-table-small uk-table-striped">
            <thead>
            <tr>
                @yield('table-headers')
            </tr>
            </thead>

            <tbody>
                @yield('table-body')
            </tbody>
        </table>
    </div>

@endsection

@push('scripts-last')
    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    @yield('table-settings')

    <script>
        $(function() {
            $('.dataTables_length').addClass('uk-margin');
            $('select[name="data-table_length"]').addClass('uk-select uk-form-small').css('width', 'auto');
            $('#data-table_filter').find('input').addClass('uk-input uk-form-small').css('width', 'auto');
        })
    </script>
@endpush
