<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyInvite extends Model
{
  protected $fillable = [
    'sender_id',
    'receiver_id',
    'family_id',
    'status',
  ];
}
