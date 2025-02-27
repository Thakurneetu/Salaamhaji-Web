<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class FoodMaster extends Model implements Auditable
{
  use SoftDeletes, AuditableTrait;
  protected $fillable = [
    'category_id',
    'name',
    'price',
    'serves',
    'status',
    'image',
    'thumbnail'
  ];
  protected $dates = ['deleted_at'];
  protected $hidden = ['image','thumbnail'];
  protected $appends = ['image_url', 'thumb_url'];

  public function getImageUrlAttribute()
  {
    if($this->image != ''){
      return asset($this->image);
    }else{
      return '';
    }
  }
  public function getThumbUrlAttribute()
  {
    if($this->thumbnail != ''){
      return asset($this->thumbnail);
    }else{
      return '';
    }
  }
}
