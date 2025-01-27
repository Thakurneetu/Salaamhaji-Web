<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
  protected $fillable = [
    'name',
    'email',
    'phone',
    'catalogue',
    'address1',
    'address2',
    'city',
    'state',
    'zip',
    'country_id',
    'status'
  ];

  public function country()
  {
    return $this->belongsTo(Country::class);
  }
}
