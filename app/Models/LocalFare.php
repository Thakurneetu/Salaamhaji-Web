<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class LocalFare extends Model implements Auditable
{
  use AuditableTrait;

  protected $fillable = [
    'location_id',
    'cab_id',
    'price'
  ];

  public function cab() : BelongsTo
  {
    return $this->belongsTo(Cab::class);
  }

  public function origin() : BelongsTo
  {
    return $this->belongsTo(Location::class, 'location_id');
  }
}
