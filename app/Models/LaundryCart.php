<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

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

  protected $appends = ['category_name','formatted_date'];
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
  public function getFormattedDateAttribute()
  {
      $dateString = null;
      if($this->service_date != '') {
        if($this->start != '') {
          $service_date = Carbon::parse($this->service_date.' '.$this->start);
        }else {
          $service_date = Carbon::parse($this->service_date);
        }
        $dateString = $service_date->format('jS M, D - h:i A');
      }

      return $dateString;
  }
}
