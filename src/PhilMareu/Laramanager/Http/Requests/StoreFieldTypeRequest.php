<?php
/**
 * Created by PhpStorm.
 * User: philmareu
 * Date: 7/23/18
 * Time: 11:57 AM
 */

namespace PhilMareu\Laramanager\Http\Requests;


class StoreFieldTypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255|unique:laramanager_field_types',
            'slug' => 'required|max:255|unique:laramanager_field_types',
            'class' => 'required|max:255|unique:laramanager_field_types',
            'active' => 'boolean'
        ];
    }
}