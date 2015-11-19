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
            <td>Image</td>
            <td>Title</td>
            <td></td>
        </tr>
        </thead>

        <tbody>
        @foreach($bands as $band)
            <tr>
                <td><img src="{{ url('images/small/' . $band->image) }}" alt="{{ $band->title }} Image" width="60"></td>
                <td>{{ $band->title }}</td>
                <td class="uk-text-right">
                    <a href="{{ route('admin.bands.edit', $band->id) }}" class="uk-button">
                        <i class="uk-icon-pencil"></i>
                    </a>

                    <form action="{{ route('admin.bands.destroy', $band->id) }}" method="POST" class="uk-form uk-display-inline-block">
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











    @foreach($resources as $resource)
        @foreach($fields as $field)
            @unless(isset($field['list']) && $field['list'] === false)
                {{ $resource->$field['slug'] }} |
            @endunless
        @endforeach
    @endforeach

@endsection

@section('scripts')

    <script src="{{ asset('vendor/laramanager/js/datatables.min.js') }}"></script>

@endsection