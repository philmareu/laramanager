@if(isset($image))
    <img src="{{ url('images/image-browser/' . $image->filename) }}" alt="{{ $image->alt }}"
         data-laramanager-image-id="{{ $image->id }}"
         data-laramanager-filename="{{ $image->filename }}"
         class="unselected-image {{ $image->alt == '' ? 'needs-alt' : '' }}">
@endif