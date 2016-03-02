<?php namespace Philsquare\LaraManager\ViewComposers; 

use Illuminate\Contracts\View\View;
use Philsquare\LaraManager\Models\Image;

class ImageBrowserViewComposer
{

    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function compose(View $view)
    {
        $images = $this->image->latest()->limit(50)->get();

        $view->with(compact('images'));
    }

}