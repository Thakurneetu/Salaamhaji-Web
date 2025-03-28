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
    'icon',
    'area_id'
  ];
  protected $dates = ['deleted_at'];
  protected $appends = ['icon_url'];

  public function category() : BelongsTo
  {
    return $this->belongsTo(LoundryCategory::class, 'category_id');
  }

  public function area() : BelongsTo
  {
    return $this->belongsTo(Area::class);
  }

  public function getIconUrlAttribute()
  {
    if($this->icon != ''){
      return asset($this->icon);
    }else{
      return '';
    }
  }
}

