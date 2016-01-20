<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateDataInFilesTable extends Migration
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
            DB::table('files')->where('id', $file->id)->update([
                'title' => 'Untitled',
                'description' => '',
                'type' => 'image',
                'original_filename' => 'unknown'
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

    }
}
