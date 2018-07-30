<?php

namespace PhilMareu\Laramanager\Seeders;

use Illuminate\Database\Seeder;
use PhilMareu\Laramanager\Models\LaramanagerFieldType;

class FieldTypesSeeder extends Seeder
{
    protected $coreFieldTypes = [
        [
            'id' => 1,
            'title' => 'Text',
            'slug' => 'text',
            'class' => 'PhilMareu\Laramanager\FieldTypes\TextFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 2,
            'title' => 'Email',
            'slug' => 'email',
            'class' => 'PhilMareu\Laramanager\FieldTypes\EmailFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 3,
            'title' => 'Slug',
            'slug' => 'slug',
            'class' => 'PhilMareu\Laramanager\FieldTypes\SlugFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 4,
            'title' => 'Password',
            'slug' => 'password',
            'class' => 'PhilMareu\Laramanager\FieldTypes\PasswordFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 5,
            'title' => 'Image',
            'slug' => 'image',
            'class' => 'PhilMareu\Laramanager\FieldTypes\ImageFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 6,
            'title' => 'Images',
            'slug' => 'images',
            'class' => 'PhilMareu\Laramanager\FieldTypes\ImagesFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 7,
            'title' => 'Checkbox',
            'slug' => 'checkbox',
            'class' => 'PhilMareu\Laramanager\FieldTypes\CheckboxFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 8,
            'title' => 'Textarea',
            'slug' => 'textarea',
            'class' => 'PhilMareu\Laramanager\FieldTypes\TextareaFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 9,
            'title' => 'CKEditor',
            'slug' => 'ckeditor',
            'class' => 'PhilMareu\Laramanager\FieldTypes\CKEditorFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 10,
            'title' => 'Select',
            'slug' => 'select',
            'class' => 'PhilMareu\Laramanager\FieldTypes\SelectFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 11,
            'title' => 'Date',
            'slug' => 'date',
            'class' => 'PhilMareu\Laramanager\FieldTypes\DateFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 12,
            'title' => 'Relational',
            'slug' => 'relational',
            'class' => 'PhilMareu\Laramanager\FieldTypes\RelationalFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ],
        [
            'id' => 13,
            'title' => 'Markdown',
            'slug' => 'markdown',
            'class' => 'PhilMareu\Laramanager\FieldTypes\MarkdownFieldType',
            'views' => 'laramanager::field_types',
            'active' => 1
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LaramanagerFieldType::insert($this->coreFieldTypes);
    }
}
