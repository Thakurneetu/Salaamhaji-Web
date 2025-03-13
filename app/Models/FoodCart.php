<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class FoodCart extends Model
{
  protected $fillable = [
    'customer_id',
    'package_id',
    'from',
    'to',
    'meal',
    'meal_type',
    'quantity',
  ];

  public function package() : BelongsTo
  {
    return $this->belongsTo(FoodMenu::class);
  }

  public function getFormattedDateAttribute()
  {
      $from = Carbon::parse($this->from);
      $dateString = $from->format('jS M, D');
      $to = null;
      if($this->to != '') {
        $to = Carbon::parse($this->to);
      }
      if($to) {
        $dateString .= ' - ' . $to->format('jS M, D');
      }

      return $dateString;
  }

}
