<?php

namespace PhilMareu\Laramanager\Filters\Image;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class ImageBrowser implements FilterInterface {

    /**
     * Applies filter to given image
     *
     * @param  Image $image
     * @return Image
     */
    public function applyFilter(Image $image)
    {
        return $image->resize(300, null, function($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg', 40);
    }
}