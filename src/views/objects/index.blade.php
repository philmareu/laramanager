@extends('laramanager::layouts.admin.table')

@section('title')
    Objects
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.objects.create') }}" class="uk-button uk-button-primary uk-button-small">Create</a>
@endsection

@section('table-headers')
    <td>Title</td>
    <td>Slug</td>
    <td>Description</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')
    @foreach($objects as $object)
        <tr>
            <td>{{ $object->title }}</td>
            <td>{{ $object->slug }}</td>
            <td>{{ $object->description }}</td>

            <td width="50">
                <a href="{{ route('admin.objects.edit', $object->id) }}"><span uk-icon="icon: pencil;"></span></a>
            </td>
        </tr>
    @endforeach
@endsection

@section('table-settings')

    <script>

        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[1, 'asc']]
            });

        });

    </script>

@endsection