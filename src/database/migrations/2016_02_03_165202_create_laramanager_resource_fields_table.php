<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaramanagerResourceFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laramanager_resource_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_id')
                ->constrained('laramanager_resources');
            $table->string('title');
            $table->string('slug');
            $table->foreignId('field_type_id')
                ->constrained('laramanager_field_types');
            $table->string('validation');
            $table->boolean('list')->default(0);
            $table->boolean('is_unique')->default(0);
            $table->text('data')->nullable();
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
        Schema::dropIfExists('laramanager_resource_fields');
    }
}
