<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Philsquare\LaraManager\Models\LaramanagerNavigationLink;
use Philsquare\LaraManager\Models\LaramanagerResource;

class CreateResourceNavigationLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $resources = LaramanagerResource::all();

        $resources->each(function (LaramanagerResource $laramanagerResource) {
            LaramanagerNavigationLink::create([
                'title' => $laramanagerResource->title,
                'uri' => 'admin/' . $laramanagerResource->slug,
                'laramanager_navigation_section_id' => 2
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $resources = LaramanagerResource::all();

        $resources->each(function (LaramanagerResource $laramanagerResource) {
            LaramanagerNavigationLink::where('title', $laramanagerResource->title)->delete();
        });
    }
}
