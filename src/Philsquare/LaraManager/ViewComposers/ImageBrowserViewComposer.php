<?php namespace Philsquare\LaraManager\ViewComposers; 

use Illuminate\Contracts\View\View;
use Philsquare\LaraManager\Models\File;

class ImageBrowserViewComposer
{

    protected $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function compose(View $view)
    {
        $images = $this->file->where('type', 'image')->get();

        $view->with(compact('images'));
    }

}