<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'purchase',
        'price',
        'availableAmount',
        'sold',
    ];

    /**
     * @return HasOne
     */
    public function place(): HasOne
    {
        return $this->hasOne(Place::class);
    }
}
