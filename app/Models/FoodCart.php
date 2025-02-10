<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodCart extends Model
{
  protected $fillable = [
    'customer_id',
    'total',
    'service_date',
    'start',
    'end'
  ];


  public function items() : HasMany
  {
    return $this->hasMany(FoodCartItem::class);
  }
}
