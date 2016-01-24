@extends('laramanager::objects.wrappers.edit')

@section('form')

    <div id="upload-drop" class="uk-placeholder uk-text-center">
        <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
        Drag files here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (10Mb Max)
    </div>

    @if($object->data('images') == "")

        No images

    @else

        <div id="file-gallery" class="uk-grid">
            @foreach($object->data('images') as $image)
                <div class="file">
                    <img src="{{ url('images/small/' . $image) }}" alt=""/>
                    <input type="hidden" name="data[images][]" value="{{ $image }}">
                    <button class="delete-file">Delete</button>
                </div>
            @endforeach
        </div>

    @endif

    <div id="progressbar" class="uk-progress uk-hidden">
        <div class="uk-progress-bar" style="width: 0%;">...</div>
    </div>

@endsection