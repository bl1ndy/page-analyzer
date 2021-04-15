<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUrlRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url.name' => 'required|url'
        ];
    }

    public function messages()
    {
        return [
            'url.name.required' => 'URL is required',
            'url.name.unique' => 'URL is already exists',
            'url.name.url' => 'Invalid url format'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $errors = $validator->errors();
            if ($errors->any()) {
                foreach ($errors->all() as $message) {
                    flash($message)->error();
                }
            }
        });
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $url = $this->url;
        $url['name'] = mb_strtolower($this->url['name']);
        $this->getInputSource()->replace(['url' => $url]);
    }
}
