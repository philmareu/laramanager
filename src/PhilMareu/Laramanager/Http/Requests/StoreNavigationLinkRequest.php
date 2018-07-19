<?php

namespace PhilMareu\Laramanager\Http\Requests;


class StoreNavigationLinkRequest extends Request
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
            'laramanager_navigation_section_id' => 'required|exists:laramanager_navigation_sections,id',
            'title' => 'required|max:255',
            'uri' => 'required|max:255',
            'ordinal' => 'required|integer|max:100'
        ];
    }
}