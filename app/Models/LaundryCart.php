<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaundryCart extends Model
{
  protected $fillable = [
    'customer_id',
    'category_id',
    'total',
    'service_date',
    'start',
    'end',
    'area_id'
  ];

  protected $appends = ['category_name'];
  protected $hidden = ['category'];

  public function items() : HasMany
  {
    return $this->hasMany(LaundryCartItem::class);
  }
  public function category() : BelongsTo
  {
    return $this->belongsTo(LoundryCategory::class)->withTrashed();
  }
  protected function categoryName(): Attribute
  {
    return new Attribute(
      get: fn () => $this->category ? $this->category->name : null,
    );
  }
}
