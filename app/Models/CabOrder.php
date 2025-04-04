<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CabOrder extends Model
{
  protected $fillable = [
    'order_id','tour_type','origin','price','destination','cab_type','pickup_location','hours','instruction',
    'seats','luggage','customer_id','fare_id'
  ];

  public function fare() : BelongsTo
  {
    if($this->tour_type == 'local') {
      return $this->belongsTo(LocalFare::class, 'fare_id');
    }else{
      return $this->belongsTo(OutstationFare::class, 'fare_id');
    }
  }
}
