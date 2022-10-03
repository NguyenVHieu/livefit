<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyIndex extends Model
{
  use HasFactory;
  protected $table = "body_indexs";
  protected $fillable = [
    'user_id', 
    'date',
    'height',
    'weight', 
    'exercise_intansity',
    'bmi',
    'bmr',
    'tdee',
    'marco'
  ];
}
