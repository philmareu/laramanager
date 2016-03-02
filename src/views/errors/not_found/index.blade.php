@extends('laramanager::layouts.default')

@section('head')
    <link href="{{ asset("vendor/laramanager/css/datatables.css") }}" rel="stylesheet" media="screen">
@endsection

@section('title')
    404s
@endsection

@section('content')

    <div class="uk-overflow-container">
        <table id="data-table" class="stripe row-border">
            <thead>
            <tr>
                <td>Count</td>
                <td>Uri</td>
                <td>Last Hit</td>
            </tr>
            </thead>

            <tbody>
            @foreach($errors as $error)
                <tr>
                    <td>{{ $error->count }}</td>
                    <td>{{ $error->uri }}</td>
                    <td>{{ $error->updated_at->format('M gS, Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    <script>

        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50,
                "order": [[1, 'asc']]
            });

        });

    </script>

@endsection