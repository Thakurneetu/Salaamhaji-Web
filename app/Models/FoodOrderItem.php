<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class FoodOrderItem extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $fillable = [
    'food_order_id',
    'date',
    'day',
    'meal',
    'meal_items',
  ];
}
