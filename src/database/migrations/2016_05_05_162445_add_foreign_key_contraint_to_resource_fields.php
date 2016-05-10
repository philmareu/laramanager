<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyContraintToResourceFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resource_fields', function (Blueprint $table) {
            $table->foreign('resource_id')->references('id')->on('resources')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resource_fields', function (Blueprint $table) {
            $table->dropForeign('resource_fields_resource_id_foreign');
        });
    }
}
