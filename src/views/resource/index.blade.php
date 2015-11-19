@extends('laramanager::layouts.default')

@section('head')
    <link href="{{ asset("vendor/laramanager/css/datatables.css") }}" rel="stylesheet" media="screen">
@endsection

@section('title')
    {{ $title }}
@endsection

@section('content')

    <h1>??</h1>

    <div class="button-add">
        <a href="{{ route('admin.' . $resource . '.create') }}" class="uk-button">
            <i class="uk-icon-plus"></i>
            Add
        </a>
    </div>

    <table id="data-table" class="stripe row-border">
        <thead>
        <tr>
            @foreach($fields as $field)

                @unless(isset($field['list']) && $field['list'] === false)
                    <td>{{ $field['title'] }}</td>
                @endunless

            @endforeach

            <td>&nbsp;</td>
        </tr>
        </thead>

        <tbody>
        @foreach($entities as $entity)
            <tr>
                @foreach($fields as $field)
                    @unless(isset($field['list']) && $field['list'] === false)
                        <td>{{ $entity->$field['slug'] }}</td>
                    @endunless
                @endforeach

                <td class="uk-text-right">
                    <a href="{{ route('admin.' . $resource . '.edit', $entity->id) }}" class="uk-button">
                        <i class="uk-icon-pencil"></i>
                    </a>

                    <form action="{{ route('admin.' . $resource . '.destroy', $entity->id) }}" method="POST" class="uk-form uk-display-inline-block">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="uk-button uk-button-danger warning">
                            <i class="uk-icon-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')

    <script src="{{ asset('vendor/laramanager/js/datatables.min.js') }}"></script>

    <script>
        $(function() {
            $('#data-table').DataTable({
                "pageLength": 50
            });
        });
    </script>

@endsection