@extends('laramanager::objects.wrappers.create')

@section('form')

    <div id="images" class="uk-grid uk-grid-small uk-sortable" data-uk-sortable></div>

    <button type="button" class="uk-button" data-uk-modal="{target:'#modal-image-browser-multiple'}">Browse</button>

@endsection