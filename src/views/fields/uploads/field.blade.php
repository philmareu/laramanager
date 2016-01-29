<div id="images">
    @if(isset($field['value']))
        {{ dd($field['value']) }}
    @endif
</div>

<button type="button" class="uk-button" data-uk-modal="{target:'#modal-image-browser-single'}">Browse</button>

@include('laramanager::browser.modals.single')