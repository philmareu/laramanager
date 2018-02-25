<image-field :field="{{ $field }}"
             :selected-image="selectedImage"
             :active-field="activeField"
             :errors="{{ $errors }}"
             :old="{{ is_null(old($field->slug)) ? 'null' : old($field->slug) }}"
             :entity-image="{{ isset($entity) && $entity->{$field->data['method']} ? $entity->{$field->data['method']} : 'null' }}"
             v-on:open-browser="openBrowser"></image-field>