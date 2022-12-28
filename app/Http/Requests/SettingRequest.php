<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        $action = $this->isMethod('POST') ? 'create' : 'edit';
        return auth()->user()->can("settings-$action");
    }

    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->rulesStore() : $this->rulesUpdate();
    }

    public function attributes(): array
    {
        return [
            'keyword' => 'Açar söz',
            'content' => 'Məzmun'
        ];
    }

    protected function rulesStore(): array
    {
        return [
            'keyword' => ['required', 'max:30', 'unique:settings'],
            'content' => ['required']
        ];
    }

    protected function rulesUpdate(): array
    {
        return [
            'content' => ['required']
        ];
    }
}
