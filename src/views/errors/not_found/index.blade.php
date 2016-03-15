@extends('laramanager::layouts.default')

@section('head')
    <link href="{{ asset("vendor/laramanager/css/datatables.css") }}" rel="stylesheet" media="screen">
@endsection

@section('title')
    404s
@endsection

@section('actions')
    <a href="{{ route('admin.objects.create') }}" class="uk-float-right"><i class="uk-icon-plus"></i> Reset</a>
@endsection

@section('content')

    <!-- This is the tabbed navigation containing the toggling elements -->
    <ul class="uk-tab" data-uk-tab="{connect:'#not-found-errors-tabs'}">
        <li><a href="">Last 7</a></li>
        <li><a href="">All</a></li>
    </ul>

    <!-- This is the container of the content items -->
    <ul id="not-found-errors-tabs" class="uk-switcher uk-margin">
        <li>
            <div class="uk-overflow-container">
                <table id="data-table-last-7" class="stripe row-border">
                    <thead>
                    <tr>
                        <td>Count</td>
                        <td>Uri</td>
                        <td>Last Hit</td>
                        <td>&nbps;</td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($last7 as $error)
                        <tr>
                            <td>{{ $error->count }}</td>
                            <td>{{ $error->uri }}</td>
                            <td>{{ $error->updated_at->format('M jS, Y') }}</td>
                            <td><a href="#" class="uk-text-danger delete" data-resource-id="{{ $error->id }}"><i class="uk-icon-trash"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </li>
        <li>
            <div class="uk-overflow-container">
                <table id="data-table-all" class="stripe row-border">
                    <thead>
                    <tr>
                        <td>Count</td>
                        <td>Uri</td>
                        <td>Last Hit</td>
                        <td>&nbsp;</td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($all as $error)
                        <tr>
                            <td>{{ $error->count }}</td>
                            <td>{{ $error->uri }}</td>
                            <td>{{ $error->updated_at->format('M jS, Y') }}</td>
                            <td><a href="#" class="uk-text-danger delete" data-resource-id="{{ $error->id }}"><i class="uk-icon-trash"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </li>
    </ul>



@endsection

@section('scripts')

    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    <script>

        $(function() {
            $('#data-table-last-7').DataTable({
                "pageLength": 50,
                "order": [[0, 'desc']]
            });

            $('#data-table-all').DataTable({
                "pageLength": 50,
                "order": [[0, 'desc']]
            });

            var resource = "not-founds";

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