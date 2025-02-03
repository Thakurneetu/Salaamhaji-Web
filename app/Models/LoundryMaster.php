<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoundryMaster extends Model
{
  use SoftDeletes;
  protected $fillable = [
    'category_id',
    'name',
    'price',
    'status',
  ];
  protected $dates = ['deleted_at'];
}

// LoundryMaster::withTrashed()->get();
