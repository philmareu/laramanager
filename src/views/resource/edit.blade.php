@extends('laramanager::layouts.default')

@section('title')
    {{ $title or 'Edit' }}
@endsection

@section('content')

    <form action="{{ route('admin.' . $resource . '.update', $entity->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @foreach($fields as $field)

            @include('laraform::elements.form.' . $field['type'], ['field' => ['name' => $field['name'], 'value' => $entity->$field['name']]])

        @endforeach

        <div class="uk-form-row">
            <div class="uk-width-1-6">
                @include('laraform::elements.form.submit')
            </div>
        </div>

    </form>

@endsection