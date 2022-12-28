<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = ['name', 'image', 'position_id', 'status'];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
