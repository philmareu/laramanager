@extends('laramanager::layouts.sub.table')

@section('title')
    Navigation Links
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.laramanager-navigation-links.create') }}" class="uk-button uk-button-small uk-button-primary">Create</a>
@endsection

@section('table-headers')
    <td>Section</td>
    <td>Title</td>
    <td>URI</td>
    <td>Ordinal</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')
    @foreach($links as $link)
        <tr>
            <td>{{ $link->section->title }}</td>
            <td>{{ $link->ordinal }}</td>
            <td>{{ $link->title }}</td>
            <td>{{ $link->uri }}</td>

            <td width="50">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-1-2">
                        <a href="{{ route('admin.laramanager-navigation-links.edit', $link->id) }}"><span uk-icon="icon: pencil;"></span></a>
                    </div>
                    <div class="uk-width-1-2">
                        <a href="#" class="uk-text-danger delete" data-link-id="{{ $link->id }}"><span uk-icon="icon: trash;"></span></a>
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
                "order": [[0, 'asc'], [1, 'asc']]
            });

        });

        $('table').on('click', '.delete', function(event) {
            let r = confirm("Are you sure?");

            event.preventDefault();

            if (r === true) {
                let element = $(this);
                let id = element.attr('data-link-id');
                let td = element.parents('td');
                let row = element.parents('tr');

                $.ajax({
                    url: SITE_URL + '/admin/laramanager-navigation-links/' + id,
                    type: 'POST',
                    data: {_method: 'DELETE', _token: csrf},
                    success: function(response) {
                        if(response.status === 'ok') {
                            row.addClass('uk-text-muted');
                            td.html('Deleted');
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        });

    </script>

@endsection