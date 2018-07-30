@extends('laramanager::layouts.admin.default')

@section('title')
    Create
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.resources.index') }}">Resources</a></li>
    <li class="uk-disabled"><a>{{ $resource->title }}</a></li>
    <li><a href="{{ url('admin/resources/' . $resource->id . '/fields') }}">Fields</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

    <form action="{{ url('admin/resources/' . $resource->id . '/fields/create') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title']])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title', 'label' => 'Slug (column name)']])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'validation']])
        @include('laramanager::partials.elements.form.checkbox', ['field' => ['name' => 'is_unique', 'checked' => false]])
        @include('laramanager::partials.elements.form.checkbox', ['field' => ['name' => 'list', 'checked' => false]])
        @include('laramanager::partials.elements.form.select', ['field' => ['name' => 'field_type_id', 'options' => $fieldTypes->pluck('title', 'id'), 'id' => 'type']])

        <div id="options" class="uk-form-row">

        </div>

        @include('laramanager::partials.elements.buttons.submit')

    </form>

@endsection

@push('scripts-last')

    <script>
        $(function() {

            $('select[name="type"]').on('change', function(event) {

                var type = event.target.value;

                $.ajax({
                    url: SITE_URL + '/admin/resources/fields/getOptions/' + type,
                    type: 'GET',
                    success: function(response) {
                        $('#options').html(response.data.html);
                    }
                })
            });

            $('#title').slugify({ slug: '#slug', type: '_' });

        });
    </script>
@endpush