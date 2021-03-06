@extends('laramanager::layouts.admin.table')

@section('title')
    Feeds
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.feeds.create') }}" class="uk-button uk-button-small uk-button-primary">Create</a>
@endsection

@section('table-headers')
    <td>Title</td>
    <td>Slug</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')
    @foreach($feeds as $feed)
        <tr>
            <td>{{ $feed->title }}</td>
            <td>{{ $feed->slug }}</td>

            <td width="50">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-1-2">
                        <a href="{{ route('admin.feeds.edit', $feed->id) }}"><span uk-icon="icon: pencil;"></span></a>
                    </div>
                    <div class="uk-width-1-2">
                        <a href="#" class="uk-text-danger delete" data-resource-id="{{ $feed->id }}"><span uk-icon="icon: trash;"></span></a>
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

        });

        var resource = "feeds";

        $(function() {

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