<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaundryOrder extends Model
{
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
