<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLaramanagerResourceFieldsAddFieldTypeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laramanager_resource_fields', function (Blueprint $table) {
            $table->unsignedInteger('laramanager_field_type_id');
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
            $table->dropColumn('laramanager_field_type_id');
        });
    }
}
