@extends('laramanager::layouts.default')

@section('head')
    <link href="{{ asset("vendor/laramanager/css/datatables.css") }}" rel="stylesheet" media="screen">
@endsection

@section('title')
    Objects
@endsection

@section('actions')
    <a href="{{ route('admin.objects.create') }}" class="uk-float-right"><i class="uk-icon-plus"></i> Add</a>
@endsection

@section('content')

    <table id="data-table" class="stripe row-border">
        <thead>
        <tr>
            <td>Title</td>
            <td>Slug</td>
            <td>Description</td>
            <td>&nbsp;</td>
        </tr>
        </thead>

        <tbody>
        @foreach($objects as $object)
            <tr>
                <td>{{ $object->title }}</td>
                <td>{{ $object->slug }}</td>
                <td>{{ $object->description }}</td>

                <td width="50">
                    <a href="{{ route('admin.objects.edit', $object->id) }}"><i class="uk-icon-pencil"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

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