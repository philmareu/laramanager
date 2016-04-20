<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Philsquare\LaraManager\Models\Setting;

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
            $table->text('value')->default('');
            $table->boolean('is_core')->default(0);
            $table->timestamps();
        });

        Setting::table('settings')->insert([
            [
                'title' => 'Site Name',
                'slug' => 'site-name',
                'description' => 'The name of the website',
                'type' => 'text',
                'value' => 'Admin',
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
