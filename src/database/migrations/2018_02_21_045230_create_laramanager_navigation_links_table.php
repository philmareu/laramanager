<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaramanagerNavigationLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laramanager_navigation_links', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('laramanager_navigation_section_id');
            $table->string('title');
            $table->unsignedTinyInteger('ordinal')->default(100);
            $table->string('uri');
            $table->timestamps();

            $table->foreign('laramanager_navigation_section_id', 'links_section_id')->references('id')->on('laramanager_navigation_sections')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laramanager_navigation_links');
    }
}
