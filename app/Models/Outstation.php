<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Outstation extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $fillable = [
    'origin_id',
    'destination_id',
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
    return $this->hasMany(OutstationFare::class);
  }

}
