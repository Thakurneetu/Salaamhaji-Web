<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
  protected $fillable = [
    'name',
    'email',
    'phone',
    'address1',
    'address2',
    'city',
    'state',
    'zip',
    'country_id',
    'status',
    'services',
    'laundry_catalogue',
    'food_catalogue',
    'cab_catalogue',
  ];

  public function country()
  {
    return $this->belongsTo(Country::class);
  }
}
