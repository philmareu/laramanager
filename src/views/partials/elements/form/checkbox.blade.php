@extends('laramanager::partials.wrappers.form')

@section('field')

    <input name="{{ $field['name'] }}" type="checkbox" value="1"
           class="{{ $errors->has($field['name']) ? 'uk-form-danger' : '' }} uk-checkbox"
            {{ (old($field['name']) OR $field['checked'] OR (isset($field['value']) && $field['value'] == 1)) ? 'checked="checked"' : '' }}>

@overwrite