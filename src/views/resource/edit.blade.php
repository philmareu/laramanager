@extends('laramanager::layouts.default')

@section('title')
    {{ $title or 'Edit' }}
@endsection

@section('content')

    <form action="{{ route('admin.' . $resource . '.update', $entity->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @foreach($fields as $field)

            @include('laraform::elements.form.' . $field['type'], ['name' => $field['slug'], 'value' => $entity->$field['slug']])

        @endforeach

        <div class="uk-form-row">
            @include('laraform::elements.form.submit')
        </div>

    </form>

@endsection