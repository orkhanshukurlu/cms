<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        $action = $this->isMethod('POST') ? 'create' : 'edit';
        return auth()->user()->can("categories-$action");
    }

    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->rulesStore() : $this->rulesUpdate();
    }

    public function attributes(): array
    {
        return [
            'name'   => 'Ad',
            'status' => 'Status'
        ];
    }

    protected function rulesStore(): array
    {
        return [
            'name'   => ['required', 'max:30', 'unique:categories'],
            'status' => ['required', 'boolean', 'in:0,1']
        ];
    }

    protected function rulesUpdate(): array
    {
        return [
            'name'   => ['required', 'max:30', 'unique:categories,name,' . $this->category->id],
            'status' => ['required', 'boolean', 'in:0,1']
        ];
    }
}
