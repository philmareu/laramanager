@extends('admin.layouts.default')

@section('breadcrumbs')

<ul class="breadcrumb">
	<li><a href="{{ route('admin.courses.index') }}">Courses</a></li>
	<li>{{ link_to('admin/modules/' . $page->module->course->id, $page->module->course->title) }}</li>
	<li><a href="{{ url('admin/pages/' . $page->module->id) }}">{{ $page->module->title }}</a></li>
	<li><a href="{{ url('admin/pages/' . $page->module->id . '/' . $page->id) }}">{{ $page->title }}</a></li>
	<li class="active">Edit {{ o($object->data, 'title') }} Object</li>
</ul>

@stop

@section('header')

<h1>Courses</h1>

@stop

@section('content')


		<h2>Edit {{ o($object->data, 'title') }} object</h2>

		{{ Form::open(array('url' => array('admin/objects/' . $object->id), 'method' => 'PATCH')) }}
		
		<div class="radio">
			<label>
				{{ $errors->first('active') }}
				{{ Form::radio('active', 1, $object->active) }}
				Active
			</label>
		</div>
		
		<div class="radio">
			<label>
				{{ $errors->first('active') }}
				{{ Form::radio('active', 0, ! $object->active) }}
				Draft
			</label>
		</div>

		<div class="form-group">
			{{ $errors->first('title') }}
			{{ Form::label('title', 'Admin Title (only viewed by admins)') }}
			{{ Form::text('title', o($object->data, 'title'), array('class' => 'form-control')) }}
		</div>

		@yield('form')

		{{ Form::submit('Save', array('class' => 'btn btn-default')) }}

		{{ link_to(URL::previous(), 'Cancel') }}

		{{ Form::close() }}
	
@stop