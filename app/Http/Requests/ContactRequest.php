<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'alpha_spaces', 'max:30'],
            'email'   => ['required', 'email', 'max:40'],
            'content' => ['required']
        ];
    }

    public function attributes(): array
    {
        return [
            'name'    => 'Name',
            'email'   => 'Email',
            'content' => 'Content'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response($validator->errors()->first(), 422));
    }
}
