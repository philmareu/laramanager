<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAllTablesWithNamespace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('errors', 'laramanager_errors');
        Schema::rename('feeds', 'laramanager_feeds');
        Schema::rename('images', 'laramanager_images');
        Schema::rename('objectables', 'laramanager_objectables');
        Schema::rename('objects', 'laramanager_objects');
        Schema::rename('redirects', 'laramanager_redirects');
        Schema::rename('resource_fields', 'laramanager_resource_fields');

        Schema::table('laramanager_resource_fields', function (Blueprint $table) {
            $table->dropForeign('resource_fields_resource_id_foreign');
        });

        Schema::rename('resources', 'laramanager_resources');

        Schema::table('laramanager_resource_fields', function (Blueprint $table) {
            $table->foreign('resource_id')->references('id')->on('laramanager_resources')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::rename('settings', 'laramanager_settings');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('laramanager_settings', 'settings');

        Schema::table('laramanager_resource_fields', function (Blueprint $table) {
            $table->dropForeign('laramanager_resource_fields_resource_id_foreign');
        });

        Schema::rename('laramanager_resources', 'resources');
        Schema::rename('laramanager_resource_fields', 'resource_fields');

        Schema::table('resource_fields', function (Blueprint $table) {
            $table->foreign('resource_id')->references('id')->on('resources')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::rename('laramanager_redirects', 'redirects');
        Schema::rename('laramanager_objects', 'objects');
        Schema::rename('laramanager_objectables', 'objectables');
        Schema::rename('laramanager_images', 'images');
        Schema::rename('laramanager_feeds', 'feeds');
        Schema::rename('laramanager_errors', 'errors');
    }
}
