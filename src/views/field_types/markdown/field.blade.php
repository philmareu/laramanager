<div class="uk-margin">
    <label for="{{ $field->slug }}" class="uk-form-label">{{ $field->title }}</label>

    <span class="uk-text-small uk-text-danger">{{ $errors->first($field->slug) }}</span>

    <div class="uk-form-controls">
        <a class="uk-button uk-button-default uk-button-small" href="#modal-markdown-{{ $field->id }}" uk-toggle>Edit</a>

        <div id="modal-markdown-{{ $field->id }}" class="uk-modal-full" uk-modal>
            <div class="uk-modal-dialog">
                <div class="uk-modal-header">
                    <button class="uk-align-right uk-button uk-button-primary uk-button-small uk-modal-close" type="button">Done</button>
                </div>
                <div class="uk-modal-body uk-height-viewport">
                    <div class="uk-grid uk-child-width-1-2@s" uk-grid>
                        <div v-pre>

                        <textarea name="{{ $field->slug }}"
                                  id="markdown-{{ $field->id }}"
                                  class="field-markdown">{{ isset($entry) ? $entry->{$field->slug} : null }}</textarea>
                        </div>
                        <div id="parsed-markdown-{{ $field->id }}"></div>
                    </div>
                </div>
            </div>
        </div>

        <div v-pre>
            <input type="hidden" id="markdown-value-{{ $field->id }}" name="{{ $field->slug }}" value="{{ isset($entry) ? $entry->{$field->slug} : null }}">
        </div>
    </div>
</div>