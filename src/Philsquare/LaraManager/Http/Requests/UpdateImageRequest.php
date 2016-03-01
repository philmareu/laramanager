<?php namespace Philsquare\LaraManager\Http\Requests;

class UpdateImageRequest extends Request {

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
            'title' => 'max:255',
            'alt' => 'max:255',
            'description' => 'max:255',
            'original_filename' => 'max:255',
            'filename' => 'required|max:110|unique:images,filename,' . $this->segment(3)
        ];
    }

}