@extends('laramanager::layouts.admin.table')

@section('title')
    {{ $resource->title }}
@endsection

@section('breadcrumbs')
    <li><span>Pages</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.' . $resource->slug . '.create') }}" class="uk-button uk-button-small uk-button-primary">Create</a>
@endsection

@section('table-headers')
    <td>ID</td>

    @each('laramanager::entries.index.thead', $resource->listedFields, 'field')

    <td>&nbsp;</td>
@endsection

@section('table-body')

    @foreach($entries as $entry)
        <tr>
            <td>{{ $entry->id }}</td>
            @foreach($resource->listedFields as $field)
                <td>
                    @include('laramanager::fields.' . $field->type . '.display')
                </td>
            @endforeach

            <td width="50">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-1-2">
                        <a href="{{ route('admin.' . $resource->slug . '.show', $entry->id) }}"><span uk-icon="icon: pencil;"></span></a>
                    </div>
                    <div class="uk-width-1-2">
                        <a href="#" class="uk-text-danger delete" data-resource-id="{{ $entry->id }}"><span uk-icon="icon: trash;"></span></a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach

@endsection

@section('table-settings')

    <script>

        let resource = "{{ $resource->slug }}";
        let orderColumn = "{{ $resource->order_column }}";
        let orderDirection = "{{ $resource->order_direction }}";

        $(function() {

            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[orderColumn, orderDirection]]
            });

            $('.dataTables_length').addClass('uk-margin');
            $('select[name="data-table_length"]').addClass('uk-select uk-form-small').css('width', 'auto');
            $('#data-table_filter').find('input').addClass('uk-input uk-form-small').css('width', 'auto');

            $('table').on('click', '.delete', function(event) {
                let r = confirm("Are you sure?");

                event.preventDefault();

                if (r === true) {
                    let element = $(this);
                    let id = element.attr('data-resource-id');
                    let td = element.parents('td');
                    let row = element.parents('tr');

                    $.ajax({
                        url: SITE_URL + '/admin/' + resource + '/' + id,
                        type: 'POST',
                        data: {_method: 'DELETE', _token: token},
                        success: function(response) {
                            if(response.status === 'ok') {
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