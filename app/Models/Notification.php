<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $fillable = ['data', 'is_read', 'customer_id', 'message', 'type'];
  protected $hidden = ['updated_at', 'customer_id'];
  protected $casts = [
    'data' => 'array',
    'is_read' => 'boolean',
  ];
}
