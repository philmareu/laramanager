<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateFileableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('file_id');
            $table->unsignedInteger('fileable_id');
            $table->string('fileable_type');
            $table->timestamps();
        });

        $files = DB::table('fileable')->get();

        foreach($files as $file)
        {
            DB::table('fileables')->insert([
                'file_id' => $file->file_id,
                'fileable_id' => $file->subject_id,
                'fileable_type' => $file->subject_type
            ]);
        }

        Schema::drop('fileable');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('fileable', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('file_id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('subject_type');
            $table->timestamps();
        });

        $files = DB::table('fileables')->get();

        foreach($files as $file)
        {
            DB::table('fileables')->insert([
                'file_id' => $file->file_id,
                'subject_id' => $file->fileable_id,
                'subject_type' => $file->fileable_type
            ]);
        }

        Schema::drop('fileables');
    }
}
