@extends('admin.objects.edit.wrapper')

@section('form')

<div class="form-group">
	{{ $errors->first('video_title') }}
	{{ Form::label('video_title', 'Video Title') }}
	{{ Form::text('video_title', o($object->data, 'title'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
	{{ $errors->first('url') }}
	{{ Form::label('url', 'Video Embed URL') }}
	{{ Form::text('url', o($object->data, 'url'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
	{{ $errors->first('alt_text') }}
	{{ Form::label('alt_text', 'Transcript or Text Version') }}
	{{ Form::textarea('alt_text', o($object->data, 'alt_text'), array('class' => 'form-control ckeditor')) }}
</div>

@stop