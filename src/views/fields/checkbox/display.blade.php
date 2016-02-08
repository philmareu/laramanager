@if($entity->{$field->slug})
    <i class="uk-icon-check"></i> {!! isset($field['label']) ? $field['label'] : ucwords(str_replace('_', ' ', $field['name'])) !!}
@endif