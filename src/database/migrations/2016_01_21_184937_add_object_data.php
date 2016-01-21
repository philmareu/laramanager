<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Philsquare\LaraManager\Models\Object;

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

        Object::create([
            'title' => 'Text',
            'slug' => 'text',
            'description' => 'Basic text field'
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
