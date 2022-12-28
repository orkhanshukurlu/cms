<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'status'];

    public function portfolio(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
