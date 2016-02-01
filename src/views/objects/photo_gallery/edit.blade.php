@extends('laramanager::objects.wrappers.edit')

@section('form')

    @if($object->data('file_ids') == "")

        No images

    @else

        <div id="images" class="uk-grid uk-grid-small uk-sortable" data-uk-sortable>
            @foreach($object->files('file_ids') as $file)
                <div class="uk-width-1-1">
                    <img src="{{ url('images/small/' . $file->filename) }}" alt=""/>
                    <input type="hidden" name="data[file_ids][]" value="{{ $file->id }}">
                </div>
            @endforeach
        </div>

    @endif

    <button type="button" class="uk-button" data-uk-modal="{target:'#modal-image-browser-multiple'}">Browse</button>

@endsection