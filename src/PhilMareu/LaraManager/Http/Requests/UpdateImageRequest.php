<?php namespace PhilMareu\LaraManager\Http\Requests;

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
        $id = $this->segment(3);

        return [
            'title' => 'required|max:255',
            'alt' => 'nullable|max:255',
            'description' => 'nullable|max:255',
            'original_filename' => 'max:255',
            'filename' => "required|unique_filename:$id|max:110|unique:laramanager_images,filename,$id"
        ];
    }

}