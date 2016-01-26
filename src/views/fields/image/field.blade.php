<div class="field-image">
    <div class="image">
        @if(isset($field['value']))
            {{ $field['value'] }}
            {{--<img src="{{ url('images/small/' . $field['value']) }}">--}}
        @endif
    </div>


    <input type="hidden" name="{{ $field['name'] }}" value="{{ $field['value'] or ''}}" id="{{ $field['id'] }}" class="file_id">

    <button type="button" class="uk-button" data-uk-modal="{target:'#modal-image-browser-single'}">Browse</button>
</div>