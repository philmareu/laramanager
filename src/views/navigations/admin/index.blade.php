@extends('laramanager::layouts.sub.table')

@section('title')
    Links
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.laramanager-navigation-links.create') }}" class="uk-button uk-button-small uk-button-primary">Create</a>
@endsection

@section('table-headers')
    <td>Section</td>
    <td>Title</td>
    <td>URI</td>
    <td>Ordinal</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')
    @foreach($links as $link)
        <tr>
            <td>{{ $link->section->title }}</td>
            <td>{{ $link->ordinal }}</td>
            <td>{{ $link->title }}</td>
            <td>{{ $link->uri }}</td>

            <td width="50">
                <a href="{{ route('admin.laramanager-navigation-links.edit', $link->id) }}"><span uk-icon="icon: pencil;"></span></a>
            </td>
        </tr>
    @endforeach
@endsection

@section('table-settings')

    <script>

        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[0, 'asc'], [1, 'asc']]
            });

        });

    </script>

@endsection