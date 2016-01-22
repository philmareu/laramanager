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
            @include('laraform::elements.form.submit')
        </div>
    </form>
	
@endsection

@section('scripts')

    @if(view()->exists('vendor.laramanager.objects.' . $object->slug . '/scripts'))
        @include('vendor.laramanager.objects.' . $object->slug . '/scripts')
    @elseif(view()->exists('laramanager::objects.' . $object->slug . '/scripts'))
        @include('laramanager::objects.' . $object->slug . '/scripts')
    @endif

@endsection