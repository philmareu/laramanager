<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLaramanagerResourceFieldsDropTypeAddKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laramanager_resource_fields', function (Blueprint $table) {
            $table->foreign('laramanager_field_type_id')->references('id')->on('laramanager_field_types')->onUpdate('cascade')->onDelete('cascade');
            $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laramanager_resource_fields', function (Blueprint $table) {
            $table->string('type');
            $table->dropForeign('laramanager_resource_fields_laramanager_field_type_id_foreign');
        });
    }
}
