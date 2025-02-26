<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocalFare extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

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
