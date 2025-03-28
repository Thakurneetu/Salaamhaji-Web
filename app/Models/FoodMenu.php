<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;

class FoodMenu extends Model implements Auditable
{
  use AuditableTrait;

  protected $fillable = [
    'package',
    'all_price',
    'single_price',
    'combo_price',
    'breakfast_start',
    'breakfast_end',
    'lunch_start',
    'lunch_end',
    'dinner_start',
    'dinner_end',
    'area_id'
  ];

  public function items() : HasMany
  {
    return $this->hasMany(MenuItem::class);
  }

  public function area() : BelongsTo
  {
    return $this->belongsTo(Area::class);
  }
}
