@extends('admin.objects.create.wrapper')

@section('form')

<div class="form-group">
	{{ $errors->first('code') }}
	{{ Form::label('code', 'Embed code') }}
	{{ Form::textarea('code', isset($page_object) ? $page_object->data->code : Input::old('code'), array('class' => 'form-control')) }}
</div>

@stop