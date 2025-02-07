<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Authenticatable
{
  use HasFactory, HasApiTokens, SoftDeletes;

  protected $guard = 'customer';

  protected $fillable = [
    'name',
    'email',
    'phone',
    'gender',
    'password',
    'status',
    'country_code'
  ];

  protected $hidden = ['password','deleted_at'];

  protected $casts = ['password' => 'hashed'];

  protected $dates = ['deleted_at'];
}
