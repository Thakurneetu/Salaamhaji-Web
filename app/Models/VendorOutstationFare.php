<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorOutstationFare extends Model
{
  protected $fillable = [
    'vendor_outstation_id',
    'cab_id',
    'price'
  ];

  public function cab() : BelongsTo
  {
    return $this->belongsTo(Cab::class)->withTrashed();
  }

  public function outstation() : BelongsTo
  {
    return $this->belongsTo(VendorOutstation::class);
  }
}
