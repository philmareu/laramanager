<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MoveFileableData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $files = DB::table('files')->get();

        foreach($files as $file)
        {
            DB::table('fileable')->insert([
                'file_id' => $file->id,
                'subject_id' => $file->subject_id,
                'subject_type' => $file->subject_type
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $files = DB::table('fileable')->get();

        foreach($files as $file)
        {
            DB::table('files')->insert([
                'id' => $file->file_id,
                'subject_id' => $file->subject_id,
                'subject_type' => $file->subject_type
            ]);
        }
    }
}
