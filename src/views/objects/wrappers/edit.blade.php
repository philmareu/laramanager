@extends('laramanager::layouts.sub.default')

@section('title')
    Edit
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.' . $resource->slug . '.index') }}">{{ $resource->title }}</a></li>
    <li><a href="{{ route('admin.' . $resource->slug . '.show', $entity->id) }}">{{ $entity->id }}</a></li>
    <li class="uk-disabled"><a>Objects</a></li>
    <li class="uk-disabled"><a>{{ $object->id }}</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('actions')
    <a href="{{ url('admin/' . $resource->slug . '/' . $entity->id) }}" class="uk-button uk-button-small uk-button-primary">Cancel</a>
@endsection

@section('default-content')

    <image-browser-modal v-on:image-selected="setSelectedImage"></image-browser-modal>

    <form action="{{ url('admin/' . $resource->slug . '/object/' . $entity->id . '/' . $object->pivot->id) }}" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'label', 'value' => $object->pivot->label]])

        @if(view()->exists('vendor/laramanager/objects/' . $object->slug . '/fields'))
            @include('vendor/laramanager/objects/' . $object->slug . '/fields')
        @else
            @include('laramanager::objects.core.' . $object->slug . '.fields')
        @endif

        @include('laramanager::partials.elements.buttons.submit', ['submitText' => 'Update'])
    </form>

@endsection

@push('scripts-last')

    @if(view()->exists('vendor.laramanager.objects.' . $object->slug . '/scripts'))
        @include('vendor.laramanager.objects.' . $object->slug . '/scripts')
    @elseif(view()->exists('laramanager::objects.core.' . $object->slug . '/scripts'))
        @include('laramanager::objects.core.' . $object->slug . '/scripts')
    @endif

@endpush