@extends('laramanager::layouts.default')

@section('head')
    <link href="{{ asset("vendor/laramanager/css/datatables.css") }}" rel="stylesheet" media="screen">
@endsection

@section('title')
    Settings
@endsection

@section('content')

    <div class="uk-overflow-container">
        <table id="data-table" class="stripe row-border">
            <thead>
            <tr>
                <td>Title</td>
                <td>Slug</td>
                <td>Value</td>
                <td>&nbsp;</td>
            </tr>
            </thead>

            <tbody>
            @foreach($settings as $setting)
                <tr>
                    <td>{{ $setting->title }}</td>
                    <td>{{ $setting->slug }}</td>
                    <td>{{ $setting->value }}</td>

                    <td width="50">
                        <a href="{{ route('admin.settings.edit', $setting->id) }}"><i class="uk-icon-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    <script>

        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[1, 'asc']]
            });

        });

    </script>

@endsection