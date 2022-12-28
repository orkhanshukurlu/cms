<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'alpha_spaces', 'max:30', 'unique:users,name,' . auth()->user()->id],
            'email'    => ['required', 'email', 'max:40', 'unique:users,email,' . auth()->user()->id],
            'password' => ['nullable', 'min:5']
        ];
    }

    public function attributes(): array
    {
        return [
            'name'     => 'Ad',
            'email'    => 'Email',
            'password' => 'Şifrə'
        ];
    }
}
