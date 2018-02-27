@extends('laramanager::layouts.sub.table')

@section('title')
    Navigation Sections
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.laramanager-navigation-sections.create') }}" class="uk-button uk-button-small uk-button-primary">Create</a>
@endsection

@section('table-headers')
    <td>Title</td>
    <td>Icon</td>
    <td>Ordinal</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')
    @foreach($sections as $section)
        <tr>
            <td>{{ $section->title }}</td>
            <td><span uk-icon="icon: {{ $section->icon }};"></span></td>
            <td>{{ $section->ordinal }}</td>

            <td width="50">
                <a href="{{ route('admin.laramanager-navigation-sections.edit', $section->id) }}"><span uk-icon="icon: pencil;"></span></a>
            </td>
        </tr>
    @endforeach
@endsection

@section('table-settings')

    <script>

        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[0, 'asc']]
            });

        });

    </script>

@endsection