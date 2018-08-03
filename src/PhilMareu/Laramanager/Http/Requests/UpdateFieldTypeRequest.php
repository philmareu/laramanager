<?php
/**
 * Created by PhpStorm.
 * User: philmareu
 * Date: 7/23/18
 * Time: 11:59 AM
 */

namespace PhilMareu\Laramanager\Http\Requests;


use Illuminate\Validation\Rule;

class UpdateFieldTypeRequest extends Request
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
            'title' => 'required|max:255|' . Rule::unique('laramanager_field_types', 'title')->ignore($this->segment(3)),
            'slug' => 'required|max:255|' . Rule::unique('laramanager_field_types', 'slug')->ignore($this->segment(3)),
            'class' => 'required|max:255|' . Rule::unique('laramanager_field_types', 'class')->ignore($this->segment(3)),
            'active' => 'boolean'
        ];
    }
}