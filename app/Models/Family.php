<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
  protected $fillable = [
    'head_id',
  ];

  public function head() : HasOne
  {
    return $this->hasOne(Customer::class, 'id', 'head_id');
  }

  public function members() : HasMany
  {
    return $this->hasMany(Customer::class);
  }
}
