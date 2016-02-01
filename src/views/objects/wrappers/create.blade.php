@extends('laramanager::layouts.default')

@section('title')
    ** Need Title **
@stop

@section('content')

	<h2>Add {{ $object->title }} object</h2>

    <form action="{{ url('admin/objects/' . $resource . '/' . $entity->id . '/' . $object->id) }}" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laraform::elements.form.text', ['field' => ['name' => 'label']])

        @yield('form')

        <div class="uk-form-row">
            @include('laraform::elements.form.submit')
            <a href="{{ url('admin/' . $resource . '/' . $entity->id) }}">Cancel</a>
        </div>
    </form>

    @include('laramanager::browser.modals.single')
    @include('laramanager::browser.modals.multiple')


@endsection

@section('scripts')

    @if(view()->exists('vendor.laramanager.objects.' . $object->slug . '/scripts'))
        @include('vendor.laramanager.objects.' . $object->slug . '/scripts')
    @elseif(view()->exists('laramanager::objects.' . $object->slug . '/scripts'))
        @include('laramanager::objects.' . $object->slug . '/scripts')
    @endif

    @include('laramanager::browser.scripts.objects')

@endsection