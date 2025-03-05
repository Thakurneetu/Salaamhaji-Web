<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Carbon\Carbon;

class Order extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $fillable = [
    'id',
    'uuid',
    'customer_id',
    'type',
    'subtotal',
    'tax',
    'grand_total',
    'service_date',
    'start',
    'end',
    'status',
    'payment_id',
    'payment_status',
    'payment_type',
    'address_line_1',
    'address_line_2',
    'landmark'
  ];

  public function customer() : BelongsTo
  {
    return $this->belongsTo(Customer::class);
  }
  public function food_items() : HasMany
  {
    return $this->hasMany(FoodOrderItem::class);
  }
  public function laundry_orders() : HasMany
  {
    return $this->hasMany(LaundryOrder::class);
  }
  public function cab_order() : HasOne
  {
    return $this->hasOne(CabOrder::class);
  }

  public function getFormattedServiceTimeAttribute()
  {
      $serviceDate = Carbon::parse($this->service_date);
      $startTime = Carbon::parse($this->start);
      $endTime = Carbon::parse($this->end);

      $today = Carbon::today();
      $isToday = $serviceDate->isSameDay($today);
      $isNext = $serviceDate->isNextDay($today);

      $dateString = $isToday ? 'Today' : ($isNext ? 'Tomorrow' : $serviceDate->format('M jS, Y'));

      $startTimeString = $startTime->format('g:i A');
      $endTimeString = $endTime->format('g:i A');

      return $dateString . ', ' . $startTimeString . ' - ' . $endTimeString;
  }
}
