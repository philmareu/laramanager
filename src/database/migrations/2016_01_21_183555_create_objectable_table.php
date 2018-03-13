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
        Schema::create('laramanager_objectables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('laramanager_object_id');
            $table->unsignedInteger('laramanager_objectable_id');
            $table->string('laramanager_objectable_type');
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
        Schema::dropIfExists('laramanager_objectables');
    }
}
