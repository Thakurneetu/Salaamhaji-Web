<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cab extends Model
{
  use SoftDeletes;
  
  protected $appends = ['icon_url'];
  protected $dates = ['deleted_at'];
  
  protected $fillable = [
    'type',
    'seats',
    'icon',
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
