<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Cab extends Model implements Auditable
{
  use SoftDeletes, AuditableTrait;
  
  protected $appends = ['icon_url'];
  protected $dates = ['deleted_at'];
  protected $hidden = ['created_at','updated_at','deleted_at', 'icon'];
  
  protected $fillable = [
    'type',
    'seats',
    'icon',
    'luggage',
  ];

  public function getIconUrlAttribute()
  {
    if($this->icon != ''){
      return asset($this->icon);
    }else{
      return '';
    }
  }
}
