@extends('laramanager::layouts.default')

@section('head')
    <link href="{{ asset("vendor/laramanager/css/datatables.css") }}" rel="stylesheet" media="screen">
@endsection

@section('title')
    {{ $resource->title }}
@endsection

@section('actions')
    <a href="{{ route('admin.' . $resource->slug . '.create') }}" class="uk-float-right"><i class="uk-icon-plus"></i> Add</a>
@endsection

@section('content')

    <div class="uk-overflow-container">
        <table id="data-table" class="stripe row-border">
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
                                <a href="{{ route('admin.' . $resource->slug . '.show', $entity->id) }}"><i class="uk-icon-pencil"></i></a>
                            </div>
                            <div class="uk-width-1-2">
                                <a href="#" class="uk-text-danger delete" data-resource-id="{{ $entity->id }}"><i class="uk-icon-trash"></i></a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    <script>

        var resource = "{{ $resource->slug }}";
        var orderColumn = "{{ $resource->order_column }}";
        var orderDirection = "{{ $resource->order_direction }}";

        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[orderColumn, orderDirection]]
            });

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