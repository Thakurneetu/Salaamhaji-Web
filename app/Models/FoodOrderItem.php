<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodOrderItem extends Model
{
  protected $fillable = [
    'order_id',
    'customer_id',
    'category_name',
    'service_name',
    'price_per_piece',
    'quantity',
    'total_price',
  ];
}
