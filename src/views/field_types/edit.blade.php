@extends('laramanager::layouts.admin.default')

@section('title')
    {{ $fieldType->title }}
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.field-types.index') }}">Field Types</a></li>
    <li class="uk-disabled"><a>Edit</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

    <form action="{{ route('admin.field-types.update', $fieldType->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title', 'value' => $fieldType->title]])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title', 'value' => $fieldType->slug]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'class', 'value' => $fieldType->class]])
        @include('laramanager::partials.elements.form.checkbox', ['field' => ['name' => 'active', 'checked' => $fieldType->active]])

        @include('laramanager::partials.elements.buttons.submit', ['submitText' => 'Update'])

    </form>

@endsection

@push('scripts-last')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endpush