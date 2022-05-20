<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'age',
    ];

    /**
     * @return BelongsToMany
     */
    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'customers_places')->withPivot(['spend_money', 'created_at']);
    }
}
