@if($entry->{$field->data['method']})
    @include('laramanager::browser.image', ['image' => $entry->{$field->data['method']}])
@endif