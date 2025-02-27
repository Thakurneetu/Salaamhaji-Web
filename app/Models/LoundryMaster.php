<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class LoundryMaster extends Model implements Auditable
{
  use AuditableTrait;
  
  use SoftDeletes;
  protected $fillable = [
    'category_id',
    'name',
    'price',
    'status',
  ];
  protected $dates = ['deleted_at'];

  public function category() : BelongsTo
  {
    return $this->belongsTo(LoundryCategory::class, 'category_id');
  }
}

// LoundryMaster::withTrashed()->get();
