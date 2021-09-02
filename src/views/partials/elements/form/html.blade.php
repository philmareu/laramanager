@extends('laramanager::partials.wrappers.form')

@section('field')

    <textarea name="{{ $field['name'] }}"
              id="{{ $field['id'] ?? '' }}"
              class="{{ $errors->has($field['name']) ? 'uk-form-danger' : '' }} uk-textarea"
              data-uk-htmleditor="{mode:'tab', markdown:true}">{{ old($field['name']) ?: (isset($field['value']) ? $field['value'] : '') }}</textarea>

@overwrite
