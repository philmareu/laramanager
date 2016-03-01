<?php namespace Philsquare\LaraManager\Http\Requests;

class CreateObjectRequest extends Request {

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
            'title' => 'required|unique',
            'slug' => 'required|unique:objects|max:255',
            'description' => 'max:255'
        ];
    }

}