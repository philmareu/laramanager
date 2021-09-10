<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaramanagerObjectablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laramanager_objectables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laramanager_object_id');
            $table->unsignedBigInteger('laramanager_objectable_id');
            $table->string('laramanager_objectable_type');
            $table->string('label');
            $table->unsignedTinyInteger('ordinal');
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
