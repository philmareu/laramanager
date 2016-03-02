@extends('laramanager::layouts.default')

@section('title')
    {{ $resource->title }} > Add Object
@stop

@section('content')

	<h2>Add {{ $object->title }} object</h2>

    <form action="{{ url('admin/objects/' . $resource->slug . '/' . $entity->id . '/' . $object->id) }}" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laraform::elements.form.text', ['field' => ['name' => 'label']])

        @yield('form')

        <div class="uk-form-row">
            <div class="uk-grid uk-flex uk-flex-middle">
                <div class="uk-width-1-2 uk-width-medium-1-4">
                    @include('laraform::elements.form.submit')
                </div>
                <div class="uk-width-1-2 uk-width-medium-1-4">
                    <a href="{{ url('admin/' . $resource->slug . '/' . $entity->id) }}">Cancel</a>
                </div>
            </div>
        </div>
    </form>

    @include('laramanager::browser.modal')


@endsection

@section('scripts')

    @if(view()->exists('vendor.laramanager.objects.' . $object->slug . '/scripts'))
        @include('vendor.laramanager.objects.' . $object->slug . '/scripts')
    @elseif(view()->exists('laramanager::objects.' . $object->slug . '/scripts'))
        @include('laramanager::objects.' . $object->slug . '/scripts')
    @endif

    @include('laramanager::browser.scripts')

@endsection