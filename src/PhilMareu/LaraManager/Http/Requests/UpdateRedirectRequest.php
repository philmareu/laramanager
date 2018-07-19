<?php namespace PhilMareu\LaraManager\Http\Requests;

class UpdateRedirectRequest extends Request {

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
            'from' => 'required|max:255',
            'to' => 'required|max:255',
            'type' => 'required|in:301,302'
        ];
    }

}