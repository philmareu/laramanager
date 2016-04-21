@extends('laramanager::partials.wrappers.form')

@section('field')

    <input name="{{ $field['name'] }}"
           type="password"
           class="{{ $field['class'] or 'uk-width-1-1' }} {{ $errors->has($field['name']) ? 'uk-form-danger' : '' }}"
           id="{{ $field['id'] or '' }}"
           placeholder="{{ $field['placeholder'] or '' }}">

@overwrite