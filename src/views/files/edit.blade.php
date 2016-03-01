<div class="uk-grid">
    <div class="uk-width-1-1 uk-width-medium-1-2 uk-text-center">
        <img src="{{ url('images/original/' . $file->filename) }}" alt="{{ $file->alt }}">
    </div>
    <div class="uk-width-1-1 uk-width-medium-1-2">
        <div class="url uk-alert uk-alert-success uk-text-break">
            {{ url('images/original/' . $file->filename) }}
        </div>
        <form class="uk-form uk-form-stacked" id="update-file" method="POST" action="{{ url('admin/files/' . $file->id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            @include('laraform::elements.form.textarea', ['field' => ['name' => 'filename', 'value' => $file->filename]])
            @include('laraform::elements.form.text', ['field' => ['name' => 'title', 'value' => $file->title]])
            @include('laraform::elements.form.textarea', ['field' => ['name' => 'description', 'value' => $file->description]])
            @include('laraform::elements.form.text', ['field' => ['name' => 'original_filename', 'value' => $file->original_filename]])
            @include('laraform::elements.form.text', ['field' => ['name' => 'alt', 'value' => $file->alt]])

            <div class="uk-form-row">
                @include('laraform::elements.form.submit', ['class' => 'uk-width-1-1 uk-width-medium-1-4 uk-text-contrast'])
            </div>
        </form>
    </div>
</div>
