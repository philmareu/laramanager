<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Philsquare\LaraManager\Models\LaramanagerObject;

class AddObjectData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();

        LaramanagerObject::create([
            'title' => 'Text',
            'slug' => 'text',
            'description' => 'Basic text field'
        ]);

        LaramanagerObject::create([
            'title' => 'WYSIWYG',
            'slug' => 'wysiwyg',
            'description' => 'Full editor'
        ]);

        LaramanagerObject::create([
            'title' => 'Photo Gallery',
            'slug' => 'photo_gallery',
            'description' => 'Capture photos for the use in a gallery, slider, etc.'
        ]);

        LaramanagerObject::create([
            'title' => 'Embed',
            'slug' => 'embed',
            'description' => 'Embed something...'
        ]);

        Model::reguard();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('objects')->truncate();
    }
}
