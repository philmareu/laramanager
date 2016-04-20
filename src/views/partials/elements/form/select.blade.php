@extends('laraform::wrappers.form')

@section('field')

    <select name="{{ $field['name'] }}">
        @foreach($field['options'] as $id => $title)
            @if(isset($field['value']) && $id == $field['value'])
                <option value="{{ $id }}" selected>{{ $title }}</option>
            @else
                <option value="{{ $id }}" {{ old($field['name']) == $id ? 'selected' : '' }}>{{ $title }}</option>
            @endif
        @endforeach
    </select>

@overwrite