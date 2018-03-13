@extends('laramanager::layouts.sub.table')

@section('title')
    Users
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.users.create') }}" class="uk-button uk-button-small uk-button-primary">Create</a>
@endsection

@section('table-headers')
    <td>Name</td>
    <td>Email</td>
    <td>Is Admin</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{!! $user->is_admin ? '<span uk-icon="icon: check;"></span>' : '' !!}</td>

            <td width="50">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-1-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}"><span uk-icon="icon: pencil;"></span></a>
                    </div>
                    <div class="uk-width-1-2">
                        <a href="#" class="uk-text-danger delete" data-resource-id="{{ $user->id }}"><i class="uk-icon-trash"></i></a>
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

        var resource = "users";

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