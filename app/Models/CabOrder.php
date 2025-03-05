<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CabOrder extends Model
{
  protected $fillable = [
    'order_id','tour_type','origin','price','destination','cab_type','pickup_location','hours','instruction',
    'seats','luggage','customer_id'
  ];
}
