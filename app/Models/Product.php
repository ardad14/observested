<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    private $name;
    private $purchase;
    private $price;
    private $available_amount;
    private $sold;
    private $place_id;
}