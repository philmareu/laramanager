@extends('laramanager::layouts.sub.table')

@section('title')
    Resources
@endsection

@section('table-name')
    {{ $resource->title }}
@endsection

@section('actions')
    <a href="{{ route('admin.' . $resource->slug . '.create') }}" class="uk-button uk-button-small uk-button-primary">Create</a>
@endsection

@section('table')

    <div class="uk-overflow-container">
        <table id="data-table" class="stripe row-border uk-table uk-table-small uk-table-striped">
            <thead>
                <tr>
                    @each('laramanager::resource.index.thead', $resource->listedFields, 'field')

                    <td>&nbsp;</td>
                </tr>
            </thead>

            <tbody>
            @foreach($entities as $entity)
                <tr>
                    @foreach($resource->listedFields as $field)
                        <td>
                            @include('laramanager::fields.' . $field->type . '.display')
                        </td>
                    @endforeach

                    <td width="50">
                        <div class="uk-grid uk-grid-medium">
                            <div class="uk-width-1-2">
                                <a href="{{ route('admin.' . $resource->slug . '.show', $entity->id) }}"><span uk-icon="icon: pencil;"></span></a>
                            </div>
                            <div class="uk-width-1-2">
                                <a href="#" class="uk-text-danger delete" data-resource-id="{{ $entity->id }}"><span uk-icon="icon: trash;"></span></a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('table-settings')

    <script>

        var resource = "{{ $resource->slug }}";
        var orderColumn = "{{ $resource->order_column }}";
        var orderDirection = "{{ $resource->order_direction }}";

        $(function() {

            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[orderColumn, orderDirection]]
            });

            $('.dataTables_length').addClass('uk-margin');
            $('select[name="data-table_length"]').addClass('uk-select uk-form-small').css('width', 'auto');
            $('#data-table_filter').find('input').addClass('uk-input uk-form-small').css('width', 'auto');

            $('table').on('click', '.delete', function(event) {
                var r = confirm("Are you sure?");

                event.preventDefault();

                if (r == true) {
                    var element = $(this);
                    var id = element.attr('data-resource-id');
                    var td = element.parents('td');
                    var row = element.parents('tr');

                    $.ajax({
                        url: SITE_URL + '/admin/' + resource + '/' + id,
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

@endsection