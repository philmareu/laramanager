@extends('admin.objects.edit.wrapper')

@section('form')

<div class="form-group">
	{{ $errors->first('text') }}
	{{ Form::label('text', 'Text') }}
	{{ Form::textarea('text', o($object->data, 'text'), array('class' => 'form-control ckeditor', 'id' => 'editor1')) }}
</div>

@stop