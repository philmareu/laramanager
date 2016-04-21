<div class="uk-grid">
    <div class="uk-width-1-1 uk-width-medium-1-2 uk-text-center">
        <img src="{{ url('images/original/' . $image->filename) }}" alt="{{ $image->alt }}">
    </div>
    <div class="uk-width-1-1 uk-width-medium-1-2">
        <div class="url uk-alert uk-alert-success uk-text-break">
            {{ url('images/original/' . $image->filename) }}
        </div>
        <form class="uk-form uk-form-stacked" id="update-image" method="POST" action="{{ url('admin/images/' . $image->id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            @include('laramanager::partials.elements.form.textarea', ['field' => ['name' => 'filename', 'value' => $image->filename]])
            @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'value' => $image->title]])
            @include('laramanager::partials.elements.form.textarea', ['field' => ['name' => 'description', 'value' => $image->description]])
            @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'original_filename', 'value' => $image->original_filename]])
            @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'alt', 'value' => $image->alt]])

            <div class="uk-form-row">
                @include('laraform::elements.form.submit', ['class' => 'uk-width-1-1 uk-width-medium-1-4 uk-text-contrast'])
            </div>
        </form>
    </div>
</div>
