@extends('admin.objects.edit.wrapper')

@section('form')

<div class="form-group">
	{{ $errors->first('code') }}
	{{ Form::label('code', 'Embed code') }}
	{{ Form::textarea('code', o($object->data, 'code'), array('class' => 'form-control')) }}
</div>

@stop