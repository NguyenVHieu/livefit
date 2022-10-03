<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  use HasFactory;
  public $table = 'password_reset';
  public $timestamps = false;
  protected $fillable = [
    'email',
    'token',
    'created at' 
  ];
}