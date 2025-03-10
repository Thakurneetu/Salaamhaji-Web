<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class MenuItem extends Model implements Auditable
{
  use AuditableTrait;

  protected $fillable = [
    'food_menu_id',
    'day',
    'meal',
    'meal_items',
  ];
}
