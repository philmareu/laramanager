@extends('laramanager::layouts.default')

@section('title')
    Edit Field for {{ $resource->title }}
@endsection

@section('content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

    <form action="{{ url('admin/resources/' . $resource->id . '/fields/' . $field->id . '/edit') }}" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laraform::elements.form.text', ['field' => ['name' => 'title', 'id' => 'title', 'value' => $field->title]])
        @include('laraform::elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title', 'value' => $field->slug]])
        @include('laraform::elements.form.slug', ['field' => ['name' => 'validation', 'value' => $field->validation]])
        @include('laraform::elements.form.checkbox', ['field' => ['name' => 'is_unique', 'checked' => $field->is_unique]])
        @include('laraform::elements.form.checkbox', ['field' => ['name' => 'list', 'checked' => $field->list]])

        @include('laraform::elements.form.select', ['field' => ['name' => 'type', 'options' => $fields, 'id' => 'type', 'value' => $field->type]])

        <div id="options" class="uk-form-row">
            @if(view()->exists('laramanager::fields.' . $field->type . '.options'))
                @include('laramanager::fields.' . $field->type . '.options')
            @endif
        </div>

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Update</button>
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