<image-field :field="{{ $field }}"
             :selected-image="selectedImage"
             :active-field-id="activeFieldId"
             :errors="{{ $errors }}"
             :old="{{ is_null(old($field->slug)) ? 'null' : old($field->slug) }}"
             :entry-image="{{ isset($entry) && $entry->{$field->data['method']} ? $entry->{$field->data['method']} : 'null' }}"
             v-on:open-browser="openBrowser"></image-field>