<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Banner extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $appends = ['image_url'];

  protected $fillable = [
    'name',
    'image',
    'status',
  ];

  public function getImageUrlAttribute()
  {
    if($this->image != ''){
      return asset($this->image);
    }else{
      return '';
    }
  }
}
