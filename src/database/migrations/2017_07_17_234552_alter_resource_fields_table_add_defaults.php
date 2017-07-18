<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterResourceFieldsTableAddDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laramanager_resource_fields', function (Blueprint $table) {
            $table->boolean('list')->default(0)->change();
            $table->boolean('is_unique')->default(0)->change();
            $table->text('data')->nullable()->change();
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
            //
        });
    }
}
