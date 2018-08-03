<div id="markdown-display-{{ $field->id }}" v-pre>
    {!!  Parsedown::instance()->text($entry->{$field->slug}) !!}
</div>