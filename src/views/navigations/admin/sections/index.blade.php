@extends('laramanager::layouts.admin.table')

@section('title')
    Navigation Sections
@endsection

@section('breadcrumbs')
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.laramanager-navigation-sections.create') }}" class="uk-button uk-button-small uk-button-primary">Create</a>
@endsection

@section('table-headers')
    <td>Title</td>
    <td>Icon</td>
    <td>Ordinal</td>
    <td>&nbsp;</td>
@endsection

@section('table-body')
    @foreach($sections as $section)
        <tr>
            <td>{{ $section->title }}</td>
            <td><span uk-icon="icon: {{ $section->icon }};"></span></td>
            <td>{{ $section->ordinal }}</td>

            <td width="50">
                <div class="uk-grid uk-grid-medium">
                    <div class="uk-width-1-2">
                        <a href="{{ route('admin.laramanager-navigation-sections.edit', $section->id) }}"><span uk-icon="icon: pencil;"></span></a>
                    </div>
                    <div class="uk-width-1-2">
                        <a href="#" class="uk-text-danger delete" data-section-id="{{ $section->id }}"><span uk-icon="icon: trash;"></span></a>
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
                "order": [[0, 'asc']]
            });

        });

        $('table').on('click', '.delete', function(event) {
            let r = confirm("Are you sure? This will also delete the links in this section.");

            event.preventDefault();

            if (r === true) {
                let element = $(this);
                let id = element.attr('data-section-id');
                let td = element.parents('td');
                let row = element.parents('tr');

                $.ajax({
                    url: SITE_URL + '/admin/laramanager-navigation-sections/' + id,
                    type: 'POST',
                    data: {_method: 'DELETE', _token: token},
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