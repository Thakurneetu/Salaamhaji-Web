<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as AuditableTrait;

class VendorFoodService extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $fillable = [
    'vendor_id',
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
  ];

  public function items() : HasMany
  {
    return $this->hasMany(VendorFoodServiceItem::class);
  }
}
