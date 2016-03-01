@inject('image', 'Philsquare\LaraManager\Models\Image')

@include('laramanager::browser.image', ['image' => $image->find($entity->{$field->slug})])