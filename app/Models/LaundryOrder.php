<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
  protected $fillable = [
    'customer_id',
    'category_name',
    'order_id',
    'total',
    'service_date',
    'start',
    'end',
    'status',
  ];
}
