<div id="images" class="uk-grid uk-grid-small uk-sortable" data-uk-sortable>
    @if(isset($field['value']) && $field['value'] != "")
        {{--{{ dd($field['value']) }}--}}
    @endif
</div>

<button type="button" class="uk-button" data-uk-modal="{target:'#modal-image-browser-multiple'}">Browse</button>