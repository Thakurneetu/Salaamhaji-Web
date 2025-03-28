<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Customer extends Authenticatable implements Auditable
{
  use HasFactory, HasApiTokens, SoftDeletes, AuditableTrait;

  protected $guard = 'customer';

  protected $fillable = [
    'name',
    'email',
    'phone',
    'gender',
    'password',
    'status',
    'country_code',
    'family_id',
    'latitude',
    'longitude',
    'family_joined_at'
  ];

  protected $hidden = ['password','deleted_at'];

  protected $casts = ['password' => 'hashed'];

  protected $dates = ['deleted_at'];

  public function orders() : HasMany
  {
    return $this->hasMany(Order::class);
  }

  public function upcomingOrders()
  {
      return $this->orders()
          ->where('service_date', '>=', date('Y-m-d'))
          ->orderBy('service_date', 'asc')
          ->orderBy('start', 'asc')
          ->take(5)
          ->get();
  }

  public function family() : BelongsTo
  {
    return $this->belongsTo(Family::class, 'family_id');
  }
}
