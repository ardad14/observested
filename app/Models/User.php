<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait, HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password'
    ];
}
