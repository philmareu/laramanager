<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laramanager_resource_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('resource_id');
            $table->string('title');
            $table->string('slug');
            $table->string('type');
            $table->string('validation');
            $table->boolean('list')->default(0);
            $table->boolean('is_unique')->default(0);
            $table->text('data')->nullable();
            $table->timestamps();

            $table->foreign('resource_id')->references('id')->on('laramanager_resources')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laramanager_resource_fields');
    }
}
