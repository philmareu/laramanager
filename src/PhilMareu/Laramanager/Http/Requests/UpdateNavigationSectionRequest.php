<?php

namespace PhilMareu\Laramanager\Http\Requests;


use Illuminate\Validation\Rule;

class UpdateNavigationSectionRequest extends Request
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
            'title' => 'required|max:255|' . Rule::unique('laramanager_navigation_sections', 'title')->ignore($this->segment(3)),
            'icon' => 'required|max:255|' . Rule::unique('laramanager_navigation_sections', 'icon')->ignore($this->segment(3)),
            'ordinal' => 'required|integer|max:100'
        ];
    }
}