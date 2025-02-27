<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class FoodOrderItem extends Model implements Auditable
{
  use AuditableTrait;
  
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
