@extends('laramanager::layouts.default')

@section('head')
    <link href="{{ asset("vendor/laramanager/css/datatables.css") }}" rel="stylesheet" media="screen">
@endsection

@section('title')
    {{ $title }}
@endsection

@section('actions')
    <a href="{{ route('admin.' . $resource . '.create') }}" class="uk-float-right"><i class="uk-icon-plus"></i> Add</a>
@endsection

@section('content')

    <table id="data-table" class="stripe row-border">
        <thead>
        <tr>
            @foreach($fields as $field)

                @if(isset($field['list']) && $field['list'] === true)
                    <td>{{ $field['title'] }}</td>
                @endif

            @endforeach

            <td>&nbsp;</td>
        </tr>
        </thead>

        <tbody>
        @foreach($entities as $entity)
            <tr>
                @foreach($fields as $field)
                    @if(isset($field['list']) && $field['list'] === true)
                        <td>{{ $entity->$field['name'] }}</td>
                    @endif
                @endforeach

                <td>
                    <div class="uk-grid uk-grid-medium">
                        <div class="uk-width-1-2">
                            <a href="{{ route('admin.' . $resource . '.edit', $entity->id) }}"><i class="uk-icon-pencil"></i></a>
                        </div>
                        <div class="uk-width-1-2">
                            <a href="#" class="uk-text-danger"><i class="uk-icon-trash"></i></a>
                        </div>
                    </div>


                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')

    <script src="{{ asset('vendor/laramanager/js/datatables.js') }}"></script>

    <script>
        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50
            });

            $('table').on('click', '.delete', function() {
                alert('testing');
            });
        });
    </script>

@endsection