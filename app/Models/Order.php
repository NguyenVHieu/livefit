<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;
  protected $fillable = [
    'datetime',
    'discount',
    'total_payment',
    'paygate',
    'status',
    'user_id',
    'object',
    'object_id',
    'notes',
    'referral_code',
    'trainer_id'
  ];

}
