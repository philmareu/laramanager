@extends('laramanager::layouts.default')

@section('head')
    <link href="{{ asset("vendor/laramanager/css/datatables.css") }}" rel="stylesheet" media="screen">
@endsection

@section('title')
    {{ $resource->title }} Fields
@endsection

@section('actions')
    <a href="{{ url('admin/resources/' . $resource->id . '/fields/create') }}" class="uk-float-right"><i class="uk-icon-plus"></i> Add</a>
@endsection

@section('content')

    <table id="data-table" class="stripe row-border">
        <thead>
        <tr>
            <td>Title</td>
            <td>Slug (column name)</td>
            <td>Type</td>
            <td>&nbsp;</td>
        </tr>
        </thead>

        <tbody>
        @foreach($resource->fields as $field)
            <tr>
                <td>{{ $field->title }}</td>
                <td>{{ $field->slug }}</td>
                <td>{{ $field->type }}</td>

                <td width="50">
                    <div class="uk-grid uk-grid-medium">
                        <div class="uk-width-1-2">
                            <a href="{{ url('admin/resources/' . $resource->id . '/fields/' . $field->id . '/edit') }}"><i class="uk-icon-pencil"></i></a>
                        </div>
                        <div class="uk-width-1-2">
                            <a href="#" class="uk-text-danger delete" data-field-id="{{ $field->id }}"><i class="uk-icon-trash"></i></a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@push('scripts-last')

    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    <script>

        var resourceId = "{{ $resource->id }}";

        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[1, 'asc']]
            });

            $('table').on('click', '.delete', function(event) {
                var r = confirm("Are you sure?");

                event.preventDefault();

                if (r == true) {
                    var element = $(this);
                    var id = element.attr('data-field-id');
                    var td = element.parents('td');
                    var row = element.parents('tr');

                    $.ajax({
                        url: SITE_URL + '/admin/resources/' + resourceId + '/fields/' + id,
                        type: 'POST',
                        data: {_method: 'DELETE', _token: csrf},
                        success: function(response) {
                            if(response.status == 'ok') {
                                row.addClass('uk-text-muted');
                                td.html('Deleted');
                            }
                        }
                    });
                }
            });
        });
    </script>

@endpush