<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model implements Auditable
{
  use SoftDeletes, AuditableTrait;
  
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'name',
    'status',
    'area_id'
  ];

  public function area() : BelongsTo
  {
    return $this->belongsTo(Area::class);
  }
}
