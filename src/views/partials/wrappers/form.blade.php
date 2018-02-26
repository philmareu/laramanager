@if(isset($field['wrapper']) && $field['wrapper'] === false)

    @yield('field')

@else

    <div class="uk-margin">

        <span class="errors">{{ $errors->first($field['name']) }}</span>

        <label for="{{ $field['name'] }}" class="uk-form-label">{!! isset($field['label']) && $field['label'] !== false ? $field['label'] : ucwords(str_replace('_', ' ', $field['name'])) !!}</label>

        <div class="uk-form-controls">
            @yield('field')
        </div>
    </div>

@endif