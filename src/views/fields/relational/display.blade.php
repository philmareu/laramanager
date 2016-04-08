@if($entity->{$field->data('method')})
    {{ $entity->{$field->data('method')}->{$field->data('title')} }}
@endif