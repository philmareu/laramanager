<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaramanagerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laramanager_images', function (Blueprint $table) {
            $table->id();
            $table->string('filename', 110);
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('original_filename');
            $table->string('alt');
            $table->unsignedInteger('size')->nullable();
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
        Schema::dropIfExists('laramanager_images');
    }
}
