<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('object_id');
            $table->unsignedInteger('objectable_id');
            $table->string('objectable_type');
            $table->string('label');
            $table->tinyInteger('ordinal');
            $table->text('data');
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
        Schema::drop('objectables');
    }
}
