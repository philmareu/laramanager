@extends('laramanager::layouts.admin.default')

@section('title')
    Create
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.' . $resource->slug . '.index') }}">{{ $resource->title }}</a></li>
    <li><span>Create</span></li>
@endsection

@section('default-content')

    <image-browser-modal v-on:image-selected="setSelectedImage"></image-browser-modal>

    <form action="{{ route('admin.' . $resource->slug . '.store') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @foreach($resource->fields as $field)

            @include($field->fieldType->getViewPath('field'), ['field' => $field])

        @endforeach

        <div class="uk-margin">
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Save</button>
        </div>

    </form>

@endsection

@push('scripts-last')

    @include('laramanager::entries.assets')

@endpush