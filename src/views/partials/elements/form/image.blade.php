@extends('laramanager::partials.wrappers.form')

@section('field')

    @if(isset($field['value']))
        <div class="image">
            <img src="{{ url('images/small/' . $field['value']) }}">
        </div>
    @endif

    <input type="file" name="{{ $field['name'] }}">

@overwrite