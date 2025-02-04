<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodMaster extends Model
{
  use SoftDeletes;
  protected $fillable = [
    'category_id',
    'name',
    'price',
    'weight',
    'status',
  ];
  protected $dates = ['deleted_at'];
}
