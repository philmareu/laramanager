@extends('laramanager::layouts.default')

@section('title')
    ** Need Title **
@stop

@section('content')

    <form action="{{ url('admin/objects/' . $resource . '/' . $entity->id . '/' . $object->pivot->id) }}" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laraform::elements.form.text', ['field' => ['name' => 'label', 'value' => $object->pivot->label]])

        @yield('form')

        <div class="uk-form-row">
            <div class="uk-grid uk-flex uk-flex-middle">
                <div class="uk-width-1-2 uk-width-medium-1-4">
                    @include('laraform::elements.form.submit')
                </div>
                <div class="uk-width-1-2 uk-width-medium-1-4">
                    <a href="{{ url('admin/' . $resource . '/' . $entity->id) }}">Cancel</a>
                </div>
            </div>
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