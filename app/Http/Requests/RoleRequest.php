<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        $action = $this->isMethod('POST') ? 'create' : 'edit';
        return auth()->user()->can("roles-$action");
    }

    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->rulesStore() : $this->rulesUpdate();
    }

    public function attributes(): array
    {
        return [
            'name'          => 'Ad',
            'permissions'   => 'İcazələr',
            'permissions.*' => 'İcazələr'
        ];
    }

    protected function rulesStore(): array
    {
        return [
            'name'          => ['required', 'max:20', 'alpha', 'unique:roles'],
            'permissions'   => ['required', 'array', 'exists:permissions,id'],
            'permissions.*' => ['distinct']
        ];
    }

    protected function rulesUpdate(): array
    {
        return [
            'name'          => ['required', 'max:20', 'alpha', 'unique:roles,name,' . $this->role->id],
            'permissions'   => ['required', 'array', 'exists:permissions,id'],
            'permissions.*' => ['distinct']
        ];
    }
}
