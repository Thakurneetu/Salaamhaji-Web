<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryOrderItem extends Model
{
  protected $fillable = [
    'laundry_order_id',
    'service_name',
    'price_per_piece',
    'quantity',
    'total_price',
  ];
}
