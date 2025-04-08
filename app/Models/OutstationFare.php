<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class OutstationFare extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $fillable = [
    'outstation_id',
    'cab_id',
    'price'
  ];

  public function cab() : BelongsTo
  {
    return $this->belongsTo(Cab::class)->withTrashed();
  }

  public function outstation() : BelongsTo
  {
    return $this->belongsTo(Outstation::class);
  }
}
