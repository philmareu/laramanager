@if($entry->{$field->data['method']})
    {{ $entry->{$field->data['method']}->{$field->data['title']} }}
@else
    
@endif