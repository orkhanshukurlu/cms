<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        $action = $this->isMethod('POST') ? 'create' : 'edit';
        return auth()->user()->can("portfolio-$action");
    }

    public function rules(): array
    {
        return $this->isMethod('POST') ? $this->rulesStore() : $this->rulesUpdate();
    }

    public function attributes(): array
    {
        return [
            'title'         => 'Başlıq',
            'description'   => 'Açıqlama',
            'image'         => 'Şəkil',
            'images'        => 'Şəkillər',
            'delete_images' => 'Silinəcək şəkillər',
            'category_id'   => 'Kateqoriya',
            'order'         => 'Sıra',
            'status'        => 'Status'
        ];
    }

    protected function rulesStore(): array
    {
        return [
            'title'       => ['required', 'max:50', 'unique:portfolio'],
            'description' => ['required'],
            'image'       => ['required', 'image', 'mimes:jpg,jpeg,png,jfif'],
            'images'      => ['required'],
            'images.*'    => ['image', 'mimes:jpg,jpeg,png,jfif'],
            'category_id' => ['required', 'exists:categories,id,status,1'],
            'order'       => ['required', 'numeric', 'gt:0', 'unique:portfolio'],
            'status'      => ['required', 'boolean', 'in:0,1']
        ];
    }

    protected function rulesUpdate(): array
    {
        return [
            'title'         => ['required', 'max:50', 'unique:portfolio,title,' . $this->portfolio->id],
            'description'   => ['required'],
            'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,jfif'],
            'images'        => ['nullable'],
            'images.*'      => ['image', 'mimes:jpg,jpeg,png,jfif'],
            'delete_images' => ['nullable', 'exists:portfolio_photos,id'],
            'category_id'   => ['required', 'exists:categories,id,status,1'],
            'order'         => ['required', 'numeric', 'gt:0'],
            'status'        => ['required', 'boolean', 'in:0,1']
        ];
    }
}
