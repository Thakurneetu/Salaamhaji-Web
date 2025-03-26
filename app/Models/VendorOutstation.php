<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VendorOutstation extends Model
{
  protected $fillable = [
    'origin_id',
    'destination_id',
    'vendor_id',
  ];

  public function origin() : BelongsTo
  {
    return $this->belongsTo(Location::class, 'origin_id');
  }
  public function destination() : BelongsTo
  {
    return $this->belongsTo(Location::class, 'destination_id');
  }
  public function fares() : HasMany
  {
    return $this->hasMany(VendorOutstationFare::class);
  }
}
