<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorLaundryService extends Model
{
  protected $fillable = [
    'vendor_id',
    'category_id',
    'name',
    'price',
    'status',
  ];
}
