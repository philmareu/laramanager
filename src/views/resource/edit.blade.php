@extends('laramanager::layouts.sub.default')

@section('title')
    Edit
@endsection

@section('page-content')

    <image-browser-modal v-on:image-selected="setSelectedImage"></image-browser-modal>

    <form action="{{ route('admin.' . $resource->slug . '.update', $entity->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @foreach($resource->fields as $field)

            @include('laramanager::fields.' . $field->type . '.field', ['field' => $field, 'entity' => $entity])

        @endforeach

        <div class="uk-margin">
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Save</button>
            <a href="{{ route('admin.' . $resource->slug . '.show', $entity->id) }}" type="submit" class="uk-button uk-button-small uk-button-default">Back</a>
        </div>

    </form>

@endsection

@push('scripts-last')

    @include('laramanager::resource.assets')

@endpush