@extends('laramanager::layouts.sub.default')

@section('title')
    Create Setting
@endsection

@section('page-content')

    <form action="{{ route('admin.settings.update', $setting->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.' . $setting->type, ['field' => ['name' => 'value', 'id' => 'title', 'label' => $setting->title, 'value' => $setting->value]])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Update</button>
        </div>

    </form>

@endsection