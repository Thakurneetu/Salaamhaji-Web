<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
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
