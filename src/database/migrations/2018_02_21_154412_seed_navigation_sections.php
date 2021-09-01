<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PhilMareu\Laramanager\Models\LaramanagerNavigationSection;

class SeedNavigationSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LaramanagerNavigationSection::forceCreate([
            'id' => 1,
            'title' => 'Reporting',
            'icon' => 'grid',
            'ordinal' => 0
        ]);

        LaramanagerNavigationSection::forceCreate([
            'id' => 2,
            'title' => 'Resources',
            'icon' => 'list',
            'is_core' => 1,
            'ordinal' => 10
        ]);

        LaramanagerNavigationSection::forceCreate([
            'id' => 3,
            'title' => 'Uploads',
            'icon' => 'image',
            'is_core' => 1,
            'ordinal' => 20
        ]);

        LaramanagerNavigationSection::forceCreate([
            'id' => 4,
            'title' => 'System',
            'icon' => 'settings',
            'is_core' => 1,
            'ordinal' => 30
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
