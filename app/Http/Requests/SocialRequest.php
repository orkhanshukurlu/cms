<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
{
    public function authorize(): bool
    {
        $action = $this->isMethod('POST') ? 'create' : 'edit';
        return auth()->user()->can("socials-$action");
    }

    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->rulesStore() : $this->rulesUpdate();
    }

    public function attributes(): array
    {
        return [
            'name'   => 'Ad',
            'link'   => 'Link',
            'status' => 'Status'
        ];
    }

    protected function rulesStore(): array
    {
        return [
            'name'   => ['required', 'max:15', 'alpha', 'unique:socials'],
            'link'   => ['required', 'max:255', 'url', 'unique:socials'],
            'status' => ['required', 'boolean', 'in:0,1']
        ];
    }

    protected function rulesUpdate(): array
    {
        return [
            'name'   => ['required', 'size:2', 'alpha', 'unique:socials,name,' . $this->social->id],
            'link'   => ['required', 'max:255', 'url', 'unique:socials,link,' . $this->social->id],
            'status' => ['required', 'boolean', 'in:0,1']
        ];
    }
}
