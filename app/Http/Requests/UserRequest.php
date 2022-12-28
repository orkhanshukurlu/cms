<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        $action = $this->isMethod('POST') ? 'create' : 'edit';
        return auth()->user()->can("users-$action");
    }

    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->rulesStore() : $this->rulesUpdate();
    }

    public function attributes(): array
    {
        return [
            'name'     => 'Ad',
            'email'    => 'Email',
            'password' => 'Sifrə',
            'role_id'  => 'Rol'
        ];
    }

    protected function rulesStore(): array
    {
        return [
            'name'     => ['required', 'alpha_spaces', 'max:30', 'unique:users'],
            'email'    => ['required', 'email', 'max:40', 'unique:users'],
            'password' => ['required', 'min:5'],
            'role_id'  => ['required', 'exists:roles,id']
        ];
    }

    protected function rulesUpdate(): array
    {
        return [
            'name'     => ['required', 'alpha_spaces', 'max:30', 'unique:users,name,' . $this->user->id],
            'email'    => ['required', 'email', 'max:40', 'unique:users,email,' . $this->user->id],
            'password' => ['nullable', 'min:5'],
            'role_id'  => ['required', 'exists:roles,id']
        ];
    }
}
