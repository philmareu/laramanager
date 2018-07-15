<div class="uk-margin">
    <label for="{{ $field->slug }}" class="uk-form-label">{{ $field->title }}</label>

    <span class="uk-text-small uk-text-danger">{{ $errors->first($field->slug) }}</span>

    <div class="uk-form-controls">
        <a class="uk-button uk-button-default uk-button-small" href="#modal-markdown-{{ $field->id }}" uk-toggle>Edit</a>

        <div id="modal-markdown-{{ $field->id }}" class="uk-modal-full" uk-modal>
            <div class="uk-modal-dialog" uk-height-viewport>
                <div class="uk-modal-header">
                    <button class="uk-align-right uk-button uk-button-primary uk-button-small uk-modal-close" type="button">Done</button>
                </div>
                <div class="uk-modal-body">
                    <div class="uk-grid-collapse uk-child-width-1-2@s" uk-grid>
                        <div class="uk-padding">

                        <textarea name="{{ $field->slug }}"
                                  id="markdown-{{ $field->id }}"
                                  class="field-markdown"
                                  rows="4">{{ isset($entity) ? $entity->{$field->slug} : null }}</textarea>
                        </div>
                        <div id="parsed-markdown-{{ $field->id }}" class="uk-padding"></div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="markdown-value-{{ $field->id }}" name="{{ $field->slug }}" value="{{ isset($entity) ? $entity->{$field->slug} : null }}">
    </div>
</div>