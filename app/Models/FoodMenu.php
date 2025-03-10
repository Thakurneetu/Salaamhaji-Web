<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as AuditableTrait;

class FoodMenu extends Model implements Auditable
{
  use AuditableTrait;

  protected $fillable = [
    'package',
    'all_price',
    'combo_price',
  ];

  public function items() : HasMany
  {
    return $this->hasMany(MenuItem::class);
  }
}
