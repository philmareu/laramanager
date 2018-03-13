<images-field :field="{{ $field }}"
             :selected-image="selectedImage"
             :active-field-id="activeFieldId"
             :errors="{{ $errors }}"
             :old="{{ is_null(old($field->slug)) ? 'null' : json_encode(old($field->slug)) }}"
             :entity-images="{{ isset($entity) && $entity->{$field->data['method']} ? $entity->{$field->data['method']} : 'null' }}"
             v-on:open-browser="openBrowser"></images-field>