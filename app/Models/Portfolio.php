<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'image', 'category_id', 'order', 'status'];

    protected $table = 'portfolio';

    public function photos(): HasMany
    {
        return $this->hasMany(PortfolioPhoto::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query): void
    {
        $query->where('status', 1);
    }

    public function updateOrder(int $old, int $new): void
    {
        $portfolio = self::whereOrder($new);

        if ($portfolio->exists()) {
            $portfolio->update(['order' => $old]);
        }
    }
}
