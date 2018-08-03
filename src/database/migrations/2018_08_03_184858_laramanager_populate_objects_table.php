<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PhilMareu\Laramanager\Models\LaramanagerObject;
use PhilMareu\Laramanager\Seeders\LaramanagerObjectsSeeder;

class LaramanagerPopulateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', ['--class' => LaramanagerObjectsSeeder::class, '--force' => true]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        LaramanagerObject::truncate();
    }
}
