<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
