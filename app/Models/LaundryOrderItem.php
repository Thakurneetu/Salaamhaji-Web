<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class LaundryOrderItem extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $fillable = [
    'laundry_order_id',
    'service_name',
    'price_per_piece',
    'quantity',
    'total_price',
  ];
}
