<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class LaundryOrder extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $fillable = [
    'customer_id',
    'category_name',
    'order_id',
    'total',
    'status',
  ];

  public function items() : HasMany
  {
    return $this->hasMany(LaundryOrderItem::class);
  }
}
