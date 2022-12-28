<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'image',
        'status'
    ];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
