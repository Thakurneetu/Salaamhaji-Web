<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Country extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $fillable = [
    'name',
  ];
}
