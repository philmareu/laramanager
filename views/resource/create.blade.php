@extends('laramanager::layouts.default')

@section('title')
    {{ $title or 'Create' }}
@endsection

@section('content')

    <form action="{{ route('admin.' . $resource . '.store') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @foreach($fields as $field)

            @include('laraform::elements.form.' . $field['type'], ['name' => $field['slug']])

        @endforeach

        <div class="uk-form-row">
            @include('laraform::elements.form.submit')
        </div>

    </form>

@endsection