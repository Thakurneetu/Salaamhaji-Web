<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorLocalFare extends Model
{
  protected $fillable = [
    'cab_id',
    'price',
    'vendor_id',
  ];

  public function cab() : BelongsTo
  {
    return $this->belongsTo(Cab::class)->withTrashed();
  }
}
