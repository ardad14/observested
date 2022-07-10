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
        'available_amount',
        'sold',
        'place_id',
    ];

    /**
     * @return HasOne
     */
    public function place(): HasOne
    {
        return $this->hasOne(Place::class);
    }
}
