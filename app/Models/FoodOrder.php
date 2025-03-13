<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodOrder extends Model
{
  protected $fillable = [
    'customer_id',
    'order_id',
    'package',
    'meal',
    'meal_type',
    'from',
    'to',
    'quantity',
    'price',
    'total',
    'breakfast_start',
    'breakfast_end',
    'lunch_start',
    'lunch_end',
    'dinner_start',
    'dinner_end',
  ];

  public function items() : HasMany
  {
    return $this->hasMany(FoodOrderItem::class);
  }
}
