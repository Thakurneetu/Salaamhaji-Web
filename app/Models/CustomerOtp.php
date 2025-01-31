<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOtp extends Model
{

  public $timestamps = false;

  protected $fillable = [
    'otp',
    'phone',
  ];
}
