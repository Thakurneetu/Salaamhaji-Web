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
    'landmark',
    'vendor_name',
    'vendor_phone',
    'vendor_address',
    'delivered_at',
    'area_id'
  ];

  public function customer() : BelongsTo
  {
    return $this->belongsTo(Customer::class)->withTrashed();
  }
  public function area() : BelongsTo
  {
    return $this->belongsTo(Area::class);
  }
  public function food_order() : HasOne
  {
    return $this->hasOne(FoodOrder::class);
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

      if($isToday) {
        $dateString = 'Today';
      } else {
        if($isNext) {
          $dateString = 'Tomorrow';
        } else {
          $dateString = $serviceDate->format('M jS, Y');
        }
      }

      $startTimeString = $startTime->format('g:i A');
      $endTimeString = $endTime->format('g:i A');

      $time = $dateString . ', ' . $startTimeString;
      if($this->end != '') {
        $time .= ' - ' . $endTimeString;
      }

      return $time;
  }
}
