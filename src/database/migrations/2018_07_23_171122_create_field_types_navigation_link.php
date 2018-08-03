<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PhilMareu\Laramanager\Models\LaramanagerNavigationLink;

class CreateFieldTypesNavigationLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LaramanagerNavigationLink::create([
            'title' => 'Field Types',
            'uri' => 'admin/field-types',
            'ordinal' => 25,
            'laramanager_navigation_section_id' => 4
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        LaramanagerNavigationLink::where('title', 'Field Types')->delete();
    }
}
