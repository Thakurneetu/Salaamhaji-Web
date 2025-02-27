<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class LoundryCategory extends Model implements Auditable
{
  use SoftDeletes, AuditableTrait;
  protected $fillable = [
    'name',
    'status',
  ];
  protected $dates = ['deleted_at'];
}
