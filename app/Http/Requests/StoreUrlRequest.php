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
            'url.name' => 'required|unique:urls,name'
        ];
    }

    public function messages()
    {
        return [
            'url.name.required' => 'A url is required',
            'url.name.unique' => 'A url is already exists',
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
    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'url.name' => fix_typos($this->title),
    //         'body' => filter_malicious_content($this->body),
    //         'tags' => convert_comma_separated_values_to_array($this->tags),
    //         'is_published' => (bool) $this->is_published,
    //     ]);
    // }
}
