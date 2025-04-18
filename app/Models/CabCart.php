<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class CabCart extends Model
{
  protected $fillable = [
    'customer_id','tour_type','service_date','start','end','fare_id','pickup_location','hours','instruction',
    'tour_location','area_id'
  ];

  public function fare() : BelongsTo
  {
    if($this->tour_type == 'local') {
      return $this->belongsTo(LocalFare::class, 'fare_id');
    }else{
      return $this->belongsTo(OutstationFare::class, 'fare_id');
    }
  }

  public function getFormattedDateAttribute()
  {
      $dateString = null;
      if($this->service_date != '') {
        if($this->start != '') {
          $service_date = Carbon::parse($this->service_date.' '.$this->start);
        }else {
          $service_date = Carbon::parse($this->service_date);
        }
        $dateString = $service_date->format('jS M, D - h:i A');
      }

      return $dateString;
  }
}
