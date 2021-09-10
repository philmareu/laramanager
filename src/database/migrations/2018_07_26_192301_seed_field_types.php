<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Migrations\Migration;
use PhilMareu\Laramanager\Seeders\FieldTypesSeeder;
use PhilMareu\Laramanager\Models\LaramanagerFieldType;

class SeedFieldTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', ['--class' => FieldTypesSeeder::class, '--force' => true]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        LaramanagerFieldType::truncate();
    }
}
