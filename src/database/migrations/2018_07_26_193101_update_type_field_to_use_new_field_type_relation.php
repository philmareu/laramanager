<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PhilMareu\Laramanager\Models\LaramanagerFieldType;
use PhilMareu\Laramanager\Models\LaramanagerResourceField;

class UpdateTypeFieldToUseNewFieldTypeRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $resourceFields = LaramanagerResourceField::all();

        $resourceFields->filter(function(LaramanagerResourceField $field) {
            return $field->type == 'wysiwyg';
        })->each(function(LaramanagerResourceField $field) {
            $fieldType = LaramanagerFieldType::where('slug', 'ckeditor')->first();
            $field->fieldType()->associate($fieldType);
            $field->save();
        });

        $resourceFields->reject(function(LaramanagerResourceField $field) {
            return $field->type == 'wysiwyg';
        })->each(function(LaramanagerResourceField $field) {
            $fieldType = LaramanagerFieldType::where('slug', $field->type)->first();
            $field->fieldType()->associate($fieldType);
            $field->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $resourceFields = LaramanagerResourceField::with('fieldType')->get();

        $resourceFields->filter(function(LaramanagerResourceField $field) {
            return $field->fieldType->slug == 'ckeditor';
        })->each(function(LaramanagerResourceField $field) {
            $field->update(['type' => 'wysiwyg']);
        });

        $resourceFields->reject(function(LaramanagerResourceField $field) {
            return $field->fieldType->slug == 'ckeditor';
        })->each(function(LaramanagerResourceField $field) {
            $field->update(['type' => $field->fieldType->slug]);
        });
    }
}
