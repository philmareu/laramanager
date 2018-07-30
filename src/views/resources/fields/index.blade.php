@extends('laramanager::layouts.admin.table')

@section('title')
    Fields
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.resources.index') }}">Resources</a></li>
    <li class="uk-disabled"><a>{{ $resource->title }}</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ url('admin/resources/' . $resource->id . '/fields/create') }}" class="uk-button uk-button-small uk-button-primary">Create Field</a>
@endsection

@section('table-headers')
    <td>Title</td>
    <td>Slug (column name)</td>
    <td>Type</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')

    @foreach($resource->fields as $field)
        <tr>
            <td>{{ $field->title }}</td>
            <td>{{ $field->slug }}</td>
            <td>{{ $field->fieldType->title }}</td>

            <td width="50">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-1-2">
                        <a href="{{ url('admin/resources/' . $resource->id . '/fields/' . $field->id . '/edit') }}"><span uk-icon="icon: pencil;"></span></a>
                    </div>
                    <div class="uk-width-1-2">
                        <a href="#" class="uk-text-danger delete" data-field-id="{{ $field->id }}"><i class="uk-icon-trash"></i></a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach

@endsection

@section('table-settings')

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
                        data: {_method: 'DELETE', _token: token},
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

@endsection