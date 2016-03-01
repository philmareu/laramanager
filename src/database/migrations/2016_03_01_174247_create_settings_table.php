<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('slug');
            $table->text('description');
            $table->enum('type', ['text', 'textarea']);
            $table->text('value');
            $table->boolean('is_core');
            $table->timestamps();
        });

        DB::table('settings')->insert([
            [
                'title' => 'Site Name',
                'slug' => 'site-name',
                'description' => 'The name of the website',
                'type' => 'text',
                'value' => 'Admin',
                'is_core' => 1
            ],
            [
                'title' => 'Integration Code',
                'slug' => 'integration-code',
                'description' => 'This code will be injected on every page.',
                'type' => 'textarea',
                'value' => '',
                'is_core' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
