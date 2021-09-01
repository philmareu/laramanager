<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PhilMareu\Laramanager\Models\LaramanagerNavigationLink;

class SeedNavigationLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LaramanagerNavigationLink::forceCreate([
            'title' => 'Dashboard',
            'uri' => 'admin/dashboard',
            'ordinal' => 0,
            'laramanager_navigation_section_id' => 1
        ]);

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
            'title' => 'Navigation Sections',
            'uri' => 'admin/laramanager-navigation-sections',
            'ordinal' => 10,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Navigation Links',
            'uri' => 'admin/laramanager-navigation-links',
            'ordinal' => 15,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Resources',
            'uri' => 'admin/resources',
            'ordinal' => 20,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Field Types',
            'uri' => 'admin/field-types',
            'ordinal' => 25,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Objects',
            'uri' => 'admin/objects',
            'ordinal' => 30,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Feeds',
            'uri' => 'admin/feeds',
            'ordinal' => 40,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Redirects',
            'uri' => 'admin/redirects',
            'ordinal' => 50,
            'laramanager_navigation_section_id' => 4
        ]);

        LaramanagerNavigationLink::forceCreate([
            'title' => 'Users',
            'uri' => 'admin/users',
            'ordinal' => 60,
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
