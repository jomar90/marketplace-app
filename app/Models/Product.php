<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'user_id',
        'name',
        'slug',
        'price',
        'stock',
        'description',
    ];

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class)->latest();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
