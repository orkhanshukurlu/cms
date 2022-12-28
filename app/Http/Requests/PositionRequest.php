<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        $action = $this->isMethod('POST') ? 'create' : 'edit';
        return auth()->user()->can("positions-$action");
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
            'name'   => ['required', 'max:30', 'unique:positions'],
            'status' => ['required', 'boolean', 'in:0,1']
        ];
    }

    protected function rulesUpdate(): array
    {
        return [
            'name'   => ['required', 'max:30', 'unique:positions,name,' . $this->position->id],
            'status' => ['required', 'boolean', 'in:0,1']
        ];
    }
}
