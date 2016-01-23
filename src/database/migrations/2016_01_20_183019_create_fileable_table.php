<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileable', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('file_id');
            $table->string('subject_type');
            $table->unsignedInteger('subject_id');
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
        Schema::drop('fileable');
    }
}
