<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CabCart extends Model
{
  protected $fillable = [
    'customer_id','tour_type','service_date','start','end','fare_id','pickup_location','hours','instruction',
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
