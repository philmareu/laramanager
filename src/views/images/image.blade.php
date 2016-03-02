<div class="image {{ $image->alt == '' ? 'needs-alt' : '' }}" data-laramanager-image-id="{{ $image->id }}">
    <img src="{{ url('images/image-browser/' . $image->filename) }}" alt="{{ $image->alt }}">
</div>
