<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class VendorFoodService extends Model implements Auditable
{
  use AuditableTrait;
  
  protected $fillable = [
    'vendor_id',
    'category_id',
    'name',
    'price',
    'serves',
    'status',
  ];
}
