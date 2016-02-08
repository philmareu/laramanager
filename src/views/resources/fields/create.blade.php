@extends('laramanager::layouts.default')

@section('title')
    Add Field to {{ $resource->title }}
@endsection

@section('content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

    <form action="{{ url('admin/resources/' . $resource->id . '/fields/create') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laraform::elements.form.text', ['field' => ['name' => 'title', 'id' => 'title']])
        @include('laraform::elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title']])
        @include('laraform::elements.form.slug', ['field' => ['name' => 'validation']])
        @include('laraform::elements.form.checkbox', ['field' => ['name' => 'is_unique', 'checked' => false]])
        @include('laraform::elements.form.checkbox', ['field' => ['name' => 'list', 'checked' => false]])

        @include('laraform::elements.form.select', ['field' => ['name' => 'type', 'options' => $fields, 'id' => 'type']])

        <div id="options" class="uk-form-row">

        </div>

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Save</button>
        </div>

    </form>

@endsection

@section('scripts')

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
@endsection