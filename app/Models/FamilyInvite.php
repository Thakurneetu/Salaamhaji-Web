<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyInvite extends Model
{
  protected $fillable = [
    'sender_id',
    'receiver_id',
    'family_id',
    'status',
  ];

  public function inviter() : BelongsTo
  {
    return $this->belongsTo(Customer::class, 'sender_id')->withTrashed();
  }
}
