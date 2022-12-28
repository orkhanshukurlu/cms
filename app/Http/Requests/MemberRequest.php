<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        $action = $this->isMethod('POST') ? 'create' : 'edit';
        return auth()->user()->can("members-$action");
    }

    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->rulesStore() : $this->rulesUpdate();
    }

    public function attributes(): array
    {
        return [
            'name'        => 'Ad',
            'image'       => 'Şəkil',
            'position_id' => 'Vəzifə',
            'status'      => 'Status'
        ];
    }

    protected function rulesStore(): array
    {
        return [
            'name'        => ['required', 'max:30', 'unique:members'],
            'image'       => ['required', 'image', 'mimes:jpg,jpeg,png,jfif', 'max:2048'],
            'position_id' => ['required', 'exists:positions,id,status,1'],
            'status'      => ['required', 'boolean', 'in:0,1']
        ];
    }

    protected function rulesUpdate(): array
    {
        return [
            'name'        => ['required', 'max:30', 'unique:members,name,' . $this->member->id],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,jfif', 'max:2048'],
            'position_id' => ['required', 'exists:positions,id,status,1'],
            'status'      => ['required', 'boolean', 'in:0,1']
        ];
    }
}
