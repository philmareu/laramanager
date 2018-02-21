<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterObjectablesTableRenameColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('laramanager_objectables', function (Blueprint $table) {
            $table->renameColumn('object_id', 'laramanager_object_id');
            $table->renameColumn('objectable_id', 'laramanager_objectable_id');
            $table->renameColumn('objectable_type', 'laramanager_objectable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laramanager_objectables', function (Blueprint $table) {
            $table->renameColumn('laramanager_object_id', 'object_id');
            $table->renameColumn('laramanager_objectable_id', 'objectable_id');
            $table->renameColumn('laramanager_objectable_type', 'objectable_type');
        });
    }
}
