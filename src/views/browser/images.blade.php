@extends('laramanager::layouts.browser')

@section('title')
Image Browser
@endsection

@section('content')
    <div id="images">
        @foreach($images as $image)

            <a href="{{ url('images/small/' . $image->filename) }}" class="select-image">{{ $image->filename }}</a>

        @endforeach
    </div>
@endsection