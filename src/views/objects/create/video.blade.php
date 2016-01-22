@extends('admin.objects.create.wrapper')

@section('form')

<div class="form-group">
	{{ $errors->first('video_title') }}
	{{ Form::label('video_title', 'Video Title') }}
	{{ Form::text('video_title', isset($page_object) ? $page_object->data->title : Input::old('video_title'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
	{{ $errors->first('url') }}
	{{ Form::label('url', 'Video Embed URL') }}
	{{ Form::text('url', isset($page_object) ? $page_object->data->url : Input::old('url'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
	{{ $errors->first('alt_text') }}
	{{ Form::label('alt_text', 'Transcript or Text Version') }}
	{{ Form::textarea('alt_text', isset($page_object) ? $page_object->data->alt_text : Input::old('alt_text'), array('class' => 'form-control ckeditor')) }}
</div>

@stop