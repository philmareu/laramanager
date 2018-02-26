@if(isset($field['wrapper']) && $field['wrapper'] === false)

    @yield('field')

@else

    <div class="uk-margin">
        <label for="{{ $field['name'] }}" class="uk-form-label">{!! isset($field['label']) && $field['label'] !== false ? $field['label'] : ucwords(str_replace('_', ' ', $field['name'])) !!}</label>

        <span class="uk-text-small uk-text-danger">{{ $errors->first($field['name']) }}</span>

        <div class="uk-form-controls">
            @yield('field')
        </div>
    </div>

@endif