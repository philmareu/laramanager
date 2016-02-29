<?php namespace Philsquare\LaraManager\Http\Requests;

class UpdateObjectRequest extends Request {

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
            'title' => 'max:255|unique:objects,title,' . $this->segment(3),
            'slug' => 'max:255|unique:objects,title,' . $this->segment(3),
            'description' => 'max:255'
        ];
    }

}