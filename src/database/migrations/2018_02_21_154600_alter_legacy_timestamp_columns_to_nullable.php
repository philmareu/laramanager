<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLegacyTimestampColumnsToNullable extends Migration
{
    protected $legacyTableNames = [
        'feeds',
        'images',
        'objectables',
        'objects',
        'redirects',
        'resource_fields',
        'resources',
        'settings'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->legacyTableNames as $tableName)
        {
            if(Schema::hasTable($tableName)) {
                Schema::table($tableName, function(Blueprint $table) {
                    $table->dateTime('created_at')->nullable()->change();
                    $table->dateTime('updated_at')->nullable()->change();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
