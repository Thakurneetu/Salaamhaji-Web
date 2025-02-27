<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OutstationFare extends Model
{
  protected $fillable = [
    'outstation_id',
    'cab_id',
    'price'
  ];

  public function cab() : BelongsTo
  {
    return $this->belongsTo(Cab::class);
  }
}
