@extends('laramanager::layouts.sub.table')

@section('title')
    Settings
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('table-headers')
    <td>Title</td>
    <td>Slug</td>
    <td>Value</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')
    @foreach($settings as $setting)
        <tr>
            <td>{{ $setting->title }}</td>
            <td>{{ $setting->slug }}</td>
            <td>{{ $setting->value }}</td>

            <td width="50">
                <a href="{{ route('admin.settings.edit', $setting->id) }}"><span uk-icon="icon: pencil;"></span></a>
            </td>
        </tr>
    @endforeach

@endsection

@section('table-settings')

    <script>

        $(function() {
            $('#data-table').dataTable({
                "pageLength": 50,
                "order": [[0, 'asc']]
            });
        });

    </script>

@endsection