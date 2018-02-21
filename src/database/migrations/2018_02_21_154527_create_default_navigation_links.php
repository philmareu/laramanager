<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Philsquare\LaraManager\Models\LaramanagerNavigationLink;

class CreateDefaultNavigationLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LaramanagerNavigationLink::forceCreate([
            'title' => 'Images',
            'uri' => 'admin/images',
            'ordinal' => 0,
            'laramanager_navigation_section_id' => 3
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Settings',
            'uri' => 'admin/settings',
            'ordinal' => 0,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Resources',
            'uri' => 'admin/resources',
            'ordinal' => 1,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Objects',
            'uri' => 'admin/objects',
            'ordinal' => 2,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Feeds',
            'uri' => 'admin/feeds',
            'ordinal' => 3,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Redirects',
            'uri' => 'admin/redirects',
            'ordinal' => 4,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Users',
            'uri' => 'admin/users',
            'ordinal' => 5,
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
        //
    }
}
