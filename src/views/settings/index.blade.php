@extends('laramanager::layouts.sub.table')

@section('title')
    Settings
@endsection

@section('page-content')

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
                        <a href="{{ route('admin.settings.edit', $setting->id) }}"><span uk-icon="icon: pencil;"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

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