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
            $table->id();
            $table->foreignId('laramanager_navigation_section_id')
                ->constrained();
            $table->string('title');
            $table->unsignedTinyInteger('ordinal')->default(100);
            $table->string('uri');
            $table->timestamps();
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
