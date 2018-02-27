@extends('laramanager::layouts.sub.default')

@section('title')
    {{ $redirect->id }}
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.redirects.index') }}">Redirects</a></li>
    <li class="uk-disabled"><a>Edit</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('page-content')

    <form action="{{ route('admin.redirects.update', $redirect->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'from', 'value' => $redirect->from]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'to', 'value' => $redirect->to]])
        @include('laramanager::partials.elements.form.select', ['field' => ['name' => 'type', 'options' => ['301' => '301 Permanent', '302' => '302 Temporary'], 'value' => $redirect->type]])

        @include('laramanager::partials.elements.buttons.submit', ['submitText' => 'Update'])

    </form>

@endsection

@push('scripts-last')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endpush