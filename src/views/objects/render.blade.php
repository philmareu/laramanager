@if(view()->exists('vendor/laramanager/objects/' . $object->slug . '/display'))
    @include('vendor/laramanager/objects/' . $object->slug . '/display')
@else
    @include('laramanager::objects/core/' . $object->slug . '/display')
@endif