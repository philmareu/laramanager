@if(isset($image))
    <div>
        <div class="uk-thumbnail">
            <img src="{{ url('images/image-browser/' . $image->filename) }}" alt="{{ $image->alt }}"
                 data-laramanager-image-id="{{ $image->id }}"
                 data-laramanager-filename="{{ $image->filename }}"
                 class="unselected-image">
            <div class="uk-thumbnail-caption">
                @if($image->alt == '')
                    <span class="uk-text-danger">No Alt Text</span>
                @else
                    {{ $image->alt }}
                @endif
            </div>
        </div>
    </div>
@endif