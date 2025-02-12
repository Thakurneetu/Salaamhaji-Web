<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
  protected $fillable = [
    'uuid',
    'customer_id',
    'type',
    'subtotal',
    'tax',
    'grand_total',
    'service_date',
    'start',
    'end',
    'status',
    'payment_id',
    'payment_status',
    'payment_type',
  ];

  public function customer() : BelongsTo
  {
    return $this->belongsTo(Customer::class);
  }
  public function food_items() : HasMany
  {
    return $this->hasMany(FoodOrderItem::class);
  }
  public function laundry_orders() : HasMany
  {
    return $this->hasMany(LaundryOrder::class);
  }
}
