<div id="markdown-display-{{ $field->id }}">
    {!!  Parsedown::instance()->text($entity->{$field->slug}) !!}
</div>