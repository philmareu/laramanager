@extends('laramanager::layouts.sub.default')

@section('title')
    Edit
@endsection

@section('page-content')

    <form action="{{ route('admin.' . $resource->slug . '.update', $entity->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @foreach($resource->fields as $field)

            @include('laramanager::fields.' . $field->type . '.field', ['field' => $field, 'entity' => $entity])

        @endforeach

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Save</button>
            <a href="{{ route('admin.' . $resource->slug . '.show', $entity->id) }}" type="submit" class="uk-button uk-button uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Back</a>
        </div>

    </form>

    @include('laramanager::browser.modal')

@endsection

@push('scripts-last')

    @include('laramanager::resource.assets')

@endpush