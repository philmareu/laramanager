@extends('laramanager::partials.wrappers.form')

@section('field')

    <textarea name="{{ $field['name'] }}"
              id="{{ $field['id'] ?? '' }}"
              class="{{ $field['class'] ?? 'uk-width-1-1' }} {{ $errors->has($field['name']) ? 'uk-form-danger' : '' }} uk-textarea">{{ old($field['name']) ?: (isset($field['value']) ? $field['value'] : '') }}</textarea>

@overwrite
