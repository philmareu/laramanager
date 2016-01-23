<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFilesFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('subject_id');
            $table->dropColumn('subject_type');
            $table->string('title');
            $table->string('description');
            $table->enum('type', ['doc', 'image', 'pdf']);
            $table->string('original_filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->unsignedInteger('subject_id');
            $table->string('subject_type');
            $table->dropColumn('title');
            $table->dropColumn('description');
            $table->dropColumn('type');
            $table->dropColumn('original_filename');
        });
    }
}
