<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFilesToImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('files', 'images');

        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->unsignedInteger('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('images', 'files');

        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('size');
            $table->enum('type', ['doc', 'image', 'pdf']);
        });
    }
}
