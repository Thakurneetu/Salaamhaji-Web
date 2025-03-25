<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorFoodServiceItem extends Model
{
  protected $fillable = [
    'vendor_food_service_id',
    'day',
    'meal',
    'meal_items',
  ];
}
