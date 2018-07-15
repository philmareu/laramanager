<a class="uk-button uk-button-default" href="#modal-full" uk-toggle>Open</a>

<div id="modal-full" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <div class="uk-grid-collapse uk-child-width-1-2@s" uk-grid>
            <div class="uk-padding" id="modal-full2">
                @include('laramanager::partials.elements.form.textarea', [
                    'field' => [
                        'name' => $field->slug,
                        'class' => 'field-markdown',
                        'id' => 'markdown-' . $field->id,
                        'value' => isset($entity) ? $entity->{$field->slug} : null
                    ]
                ])
            </div>
            <div id="parsed-markdown-{{ $field->id }}" class="uk-padding" uk-height-viewport></div>
        </div>
    </div>
</div>

<input type="hidden" id="markdown-value-{{ $field->id }}" name="{{ $field->slug }}" value="{{ isset($entity) ? $entity->{$field->slug} : null }}">