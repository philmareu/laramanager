@inject('file', 'Philsquare\LaraManager\Models\File')

@include('laramanager::fields.images.file', ['file' => $file->find($entity->{$field->slug})])