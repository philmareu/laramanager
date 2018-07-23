@extends('laramanager::layouts.admin.table')

@section('title')
    Field Types
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.field-types.create') }}" class="uk-button uk-button-primary uk-button-small">Create</a>
@endsection

@section('table-headers')
    <td>Title</td>
    <td>Slug</td>
    <td>Class</td>
    <td>Active</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')
    @foreach($fieldTypes as $fieldType)
        <tr>
            <td>{{ $fieldType->title }}</td>
            <td>{{ $fieldType->slug }}</td>
            <td>{{ $fieldType->class }}</td>
            <td>{{ $fieldType->active }}</td>

            <td width="50">
                <a href="{{ route('admin.field-types.edit', $fieldType->id) }}"><span uk-icon="icon: pencil;"></span></a>
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