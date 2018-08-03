<?php

namespace PhilMareu\Laramanager\Seeders;

use Illuminate\Database\Seeder;
use PhilMareu\Laramanager\Models\LaramanagerObject;

class LaramanagerObjectsSeeder extends Seeder
{
    protected $coreObjects = [
        [
            'title' => 'Text',
            'slug' => 'text',
            'description' => 'Basic text field'
        ],
        [
            'title' => 'WYSIWYG',
            'slug' => 'wysiwyg',
            'description' => 'Full editor'
        ]
        ,
        [
            'title' => 'Photo Gallery',
            'slug' => 'photo_gallery',
            'description' => 'Capture photos for the use in a gallery, slider, etc.'
        ],
        [
            'title' => 'Embed',
            'slug' => 'embed',
            'description' => 'Embed something...'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LaramanagerObject::insert($this->coreObjects);
    }
}
