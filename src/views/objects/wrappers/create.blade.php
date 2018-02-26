@extends('laramanager::layouts.sub.default')

@section('title')
    {{ $resource->title }} > Add Object
@stop

@section('page-content')

    <image-browser-modal v-on:image-selected="setSelectedImage"></image-browser-modal>

	<h2>Add {{ $object->title }} object</h2>

    <form action="{{ url('admin/' . $resource->slug . '/object/' . $entity->id . '/' . $object->id) }}" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'label']])

        @if(view()->exists('vendor/laramanager/objects/' . $object->slug . '/fields'))
            @include('vendor/laramanager/objects/' . $object->slug . '/fields')
        @else
            @include('laramanager::objects.core.' . $object->slug . '.fields')
        @endif

        <div class="uk-form-row">
            <div class="uk-grid uk-flex uk-flex-middle">
                <div class="uk-width-1-2 uk-width-medium-1-4">
                    @include('laramanager::partials.elements.form.submit')
                </div>
                <div class="uk-width-1-2 uk-width-medium-1-4">
                    <a href="{{ url('admin/' . $resource->slug . '/' . $entity->id) }}">Cancel</a>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('scripts-last')

    @if(view()->exists('vendor.laramanager.objects.' . $object->slug . '/scripts'))
        @include('vendor.laramanager.objects.' . $object->slug . '/scripts')
    @elseif(view()->exists('laramanager::objects.core.' . $object->slug . '/scripts'))
        @include('laramanager::objects.core.' . $object->slug . '/scripts')
    @endif

@endpush