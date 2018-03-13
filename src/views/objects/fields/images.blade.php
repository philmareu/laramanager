<object-images-field :name="{{ json_encode($name) }}"
                     :label="{{ json_encode($label) }}"
                     :object-images="{{ json_encode($object->images($name)) }}"
                     :selected-image="selectedImage"
                     :active-field-id="activeFieldId"
                     :object="{{ $object }}"
                     v-on:open-browser="openBrowser"></object-images-field>