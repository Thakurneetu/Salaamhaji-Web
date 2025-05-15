<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodCartItem extends Model
{
  protected $fillable = [
    'customer_id',
    'food_cart_id',
    'category_id',
    'service_id',
    'price_per_piece',
    'quantity',
    'total_price',
  ];

  protected $hidden = ['food_cart_id','service'];
  protected $appends = ['service_name','service_thumbnail'];

  public function service() : BelongsTo
  {
    return $this->belongsTo(FoodMaster::class)->withTrashed();
  }
  protected function serviceName(): Attribute
  {
      return new Attribute(
          get: function () {
              $name = null;
              if ($this->service) {
                  $name = $this->service->name;
              }
              return $name;
          },
      );
  }  
  protected function serviceThumbnail(): Attribute
  {
      return new Attribute(
          get: fn () => $this->getServiceThumbnail(),
      );
  }

  protected function getServiceThumbnail(): ?string
  {
      if (!$this->service) {
          return null;
      }

      return $this->service->thumb_url !== '' ? $this->service->thumb_url : null;
  }

  public function category() : BelongsTo
  {
    return $this->belongsTo(FoodCategory::class)->withTrashed();
  }
  protected function categoryName(): Attribute
  {
    return new Attribute(
      get: fn () => $this->category ? $this->category->name : null,
    );
  }
}
