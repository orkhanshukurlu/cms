<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        $action = $this->isMethod('POST') ? 'create' : 'edit';
        return auth()->user()->can("brands-$action");
    }

    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->rulesStore() : $this->rulesUpdate();
    }

    public function attributes(): array
    {
        return [
            'name'   => 'Ad',
            'image'  => 'Şəkil',
            'status' => 'Status'
        ];
    }

    protected function rulesStore(): array
    {
        return [
            'name'   => ['required', 'max:30', 'unique:brands'],
            'image'  => ['required', 'image', 'mimes:jpg,jpeg,png,jfif', 'max:2048'],
            'status' => ['required', 'boolean', 'in:0,1']
        ];
    }

    protected function rulesUpdate(): array
    {
        return [
            'name'   => ['required', 'max:20', 'unique:brands,name,' . $this->brand->id],
            'image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,jfif', 'max:2048'],
            'status' => ['required', 'boolean', 'in:0,1']
        ];
    }
}
