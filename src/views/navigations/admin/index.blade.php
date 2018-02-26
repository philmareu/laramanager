@extends('laramanager::layouts.sub.table')

@section('title')
    Navigation Links
@endsection

@section('actions')
    <a href="{{ route('admin.laramanager-navigation-links.create') }}" class="uk-float-right"><span uk-icon="icon: plus;"></span>Add</a>
@endsection

@section('table')

    <div class="uk-overflow-container">
        <table id="data-table" class="stripe row-border">
            <thead>
            <tr>
                <td>Section</td>
                <td>Title</td>
                <td>URI</td>
                <td>Ordinal</td>
                <td>&nbsp;</td>
            </tr>
            </thead>

            <tbody>
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
            </tbody>
        </table>
    </div>

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