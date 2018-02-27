@extends('laramanager::layouts.sub.default')

@section('title')
    Edit
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.' . $resource->slug . '.index') }}">{{ $resource->title }}</a></li>
    <li><a href="{{ route('admin.' . $resource->slug . '.show', $entity->id) }}">{{ $entity->id }}</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ route('admin.' . $resource->slug . '.show', $entity->id) }}" class="uk-button uk-button-small uk-button-primary">Back</a>
@endsection

@section('default-content')

    <image-browser-modal v-on:image-selected="setSelectedImage"></image-browser-modal>

    <form action="{{ route('admin.' . $resource->slug . '.update', $entity->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @foreach($resource->fields as $field)

            @include('laramanager::fields.' . $field->type . '.field', ['field' => $field, 'entity' => $entity])

        @endforeach

        <div class="uk-margin">
            @include('laramanager::partials.elements.buttons.submit', ['submitText' => 'Update'])
        </div>

    </form>

@endsection

@push('scripts-last')

    @include('laramanager::resource.assets')

@endpush