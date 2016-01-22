@extends('laramanager::layouts.default')

@section('title')
    ** Need Title **
@stop

@section('content')

	<h2>Add {{ $object->title }} object</h2>

    <form action="{{ url('admin/objects/' . $resource . '/' . $entity->id . '/' . $object->id) }}" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @yield('form')

        <div class="uk-form-row">
            @include('laraform::elements.form.submit')
        </div>
    </form>

@endsection