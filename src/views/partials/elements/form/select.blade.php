@extends('laramanager::partials.wrappers.form')

@section('field')

    <select name="{{ $field['name'] }}" class="uk-select">

        <option value="{{ null }}">None Selected</option>

        @foreach($field['options'] as $id => $title)
            @if(isset($field['value']) && $id == $field['value'])
                <option value="{{ $id }}" selected>{{ $title }}</option>
            @else
                <option value="{{ $id }}" {{ old($field['name']) == $id ? 'selected' : '' }}>{{ $title }}</option>
            @endif
        @endforeach
    </select>

@overwrite