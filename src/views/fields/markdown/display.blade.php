<div id="markdown-display-{{ $field->id }}" v-pre>
    {!!  Parsedown::instance()->text($entity->{$field->slug}) !!}
</div>