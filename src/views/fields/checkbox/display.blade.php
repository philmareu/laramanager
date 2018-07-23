@if($entry->{$field->slug})
    <span uk-icon="icon: check;"></span> {!! isset($field['label']) ? $field['label'] : ucwords(str_replace('_', ' ', $field['name'])) !!}
@endif