@extends('laramanager::layouts.sub.default')

@section('title')
    {{ $field->title }}
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.resources.index') }}">Resources</a></li>
    <li class="uk-disabled"><a>{{ $resource->title }}</a></li>
    <li><a href="{{ url('admin/resources/' . $resource->id . '/fields') }}">Fields</a></li>
    <li class="uk-disabled"><a>Edit</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

    <form action="{{ url('admin/resources/' . $resource->id . '/fields/' . $field->id . '/edit') }}" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title', 'value' => $field->title]])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title', 'value' => $field->slug, 'label' => 'Slug (column name)']])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'validation', 'value' => $field->validation]])
        @include('laramanager::partials.elements.form.checkbox', ['field' => ['name' => 'is_unique', 'checked' => $field->is_unique]])
        @include('laramanager::partials.elements.form.checkbox', ['field' => ['name' => 'list', 'checked' => $field->list]])

        @include('laramanager::partials.elements.form.select', ['field' => ['name' => 'type', 'options' => $fields, 'id' => 'type', 'value' => $field->type]])

        <div id="options" class="uk-form-row">
            @if(view()->exists('laramanager::fields.' . $field->type . '.options'))
                @include('laramanager::fields.' . $field->type . '.options')
            @endif
        </div>

        @include('laramanager::partials.elements.buttons.submit', ['submitText' => 'Update'])

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