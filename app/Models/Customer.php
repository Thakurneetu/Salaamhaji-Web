<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
  use HasFactory, HasApiTokens;

  protected $guard = 'customer';

  protected $fillable = [
    'name',
    'email',
    'phone',
    'gender',
    'password',
    'status',
  ];

  protected $hidden = ['password'];

  protected $casts = ['password' => 'hashed'];
}
