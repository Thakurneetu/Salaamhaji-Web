<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocalFare extends Model
{

  protected $fillable = [
    'location_id',
    'cab_id',
    'price_per_hour'
  ];

  public function cab() : BelongsTo
  {
    return $this->belongsTo(Cab::class);
  }
}
