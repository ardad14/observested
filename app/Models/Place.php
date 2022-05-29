<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'working_hours_start',
        'working_hours_end',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_places');
    }

    /**
     * @return BelongsToMany
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customers_places')->withPivot(['spend_money', 'created_at']);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
