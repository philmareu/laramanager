@extends('laramanager::layouts.admin.default')

@section('title')
    {{ $setting->title }}
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.settings.index') }}">Settings</a></li>
    <li class="uk-disabled"><a>Edit</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

    <form action="{{ route('admin.settings.update', $setting->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.' . $setting->type, ['field' => ['name' => 'value', 'id' => 'title', 'label' => $setting->title, 'value' => $setting->value]])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Update</button>
        </div>

    </form>

@endsection