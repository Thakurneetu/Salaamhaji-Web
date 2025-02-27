<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Location extends Model implements Auditable
{
  use SoftDeletes, AuditableTrait;
  
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'name',
    'status',
  ];

  public function local_fares() : HasMany
  {
    return $this->hasMany(LocalFare::class);
  }


}
