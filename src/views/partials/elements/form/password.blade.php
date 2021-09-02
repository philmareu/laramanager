@extends('laramanager::partials.wrappers.form')

@section('field')

    <input name="{{ $field['name'] }}"
           type="password"
           class="{{ $field['class'] ?? 'uk-width-1-1' }} {{ $errors->has($field['name']) ? 'uk-form-danger' : '' }} uk-input"
           id="{{ $field['id'] ?? '' }}"
           placeholder="{{ $field['placeholder'] ?? '' }}">

@overwrite
