@extends('laramanager::layouts.sub.table')

@section('title')
    Resources
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.resources.create') }}" class="uk-button uk-button-small uk-button-primary">Create</a>
@endsection

@section('table-headers')
    <td>Title</td>
    <td>Slug</td>
    <td>Namespace</td>
    <td>Model</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')

    @foreach($resources as $resource)
        <tr>
            <td>{{ $resource->title }}</td>
            <td>{{ $resource->slug }}</td>
            <td>{{ $resource->namespace }}</td>
            <td>{{ $resource->model }}</td>

            <td width="50">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-1-2">
                        <a href="{{ url('admin/resources/' . $resource->id . '/fields') }}"><span uk-icon="icon: list;"></span></a>
                    </div>
                    <div class="uk-width-1-2">
                        <a href="{{ route('admin.resources.edit', $resource->id) }}"><span uk-icon="icon: pencil;"></span></a>
                    </div>
                </div>
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

//            $('table').on('click', '.delete', function(event) {
//                var r = confirm("Are you sure?");
//
//                event.preventDefault();
//
//                if (r == true) {
//                    var element = $(this);
//                    var id = element.attr('data-granada-id');
//                    var td = element.parents('td');
//                    var row = element.parents('tr');
//
//                    $.ajax({
//                        url: SITE_URL + '/admin/' + resource + '/' + id,
//                        type: 'POST',
//                        data: {_method: 'DELETE', _token: csrf},
//                        success: function(response) {
//                            if(response.status == 'ok') {
//                                row.addClass('uk-text-muted');
//                                td.html('Deleted');
//                            }
//                        }
//                    });
//                }
//            });
        });
    </script>

@endsection