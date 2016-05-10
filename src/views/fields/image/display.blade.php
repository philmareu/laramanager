@if($entity->{$field->data['method']})
    @include('laramanager::browser.image', ['image' => $entity->{$field->data['method']}])
@endif