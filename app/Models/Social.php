<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['name', 'link', 'status'];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
