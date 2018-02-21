@extends('laramanager::layouts.sub.default')

@section('head')
    <link href="{{ asset("vendor/laramanager/css/datatables.css") }}" rel="stylesheet" media="screen">
@endsection

@section('title')
    Objects
@endsection

@section('actions')
    <a href="{{ route('admin.objects.create') }}" class="uk-float-right"><span uk-icon="icon: plus;"></span>Add</a>
@endsection

@section('page-content')

    <div class="uk-overflow-container">
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
                        <a href="{{ route('admin.objects.edit', $object->id) }}"><span uk-icon="icon: pencil;"></span></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('scripts-last')

    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    <script>

        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[1, 'asc']]
            });

        });

    </script>

@endpush