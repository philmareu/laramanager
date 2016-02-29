<div class="file {{ $file->alt == '' ? 'needs-alt' : '' }}" data-laramanager-file-id="{{ $file->id }}">
    <img src="{{ url('images/image-browser/' . $file->filename) }}" alt="{{ $file->alt }}">
</div>
