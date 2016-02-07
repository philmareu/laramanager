<div id="images" class="uk-grid uk-grid-small">
    **fix**
    {{--@if(isset($entity->{$field['name']}) && $entity->{$field['name']} != "")--}}
        {{--@foreach(unserialize($entity->{$field['name']}) as $fileId)--}}
            {{--@include('laramanager::fields.uploads.file', ['file' => \Philsquare\LaraManager\Models\File::find($fileId)])--}}
        {{--@endforeach--}}
    {{--@endif--}}
</div>