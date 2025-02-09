<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaundryCartItem extends Model
{
  protected $fillable = [
    'laundry_cart_id',
    'service_id',
    'price_per_piece',
    'quantity',
    'total_price',
  ];

  protected $hidden = ['laundry_cart_id','service'];
  protected $appends = ['service_name'];

  public function service() : BelongsTo
  {
    return $this->belongsTo(LoundryMaster::class);
  }
  protected function serviceName(): Attribute
  {
    return new Attribute(
      get: fn () => $this->service ? $this->service->name : null,
    );
  }
}
