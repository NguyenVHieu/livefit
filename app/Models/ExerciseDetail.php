<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseDetail extends Model
{
  use HasFactory;
  protected $table = "exercise_details";
  protected $fillable = [
    'exercise_id',
    'workout_id',
    'set',
    'rep',
    'set_rest',
    'exercise_rest',
    'total_time'
  ];

  public function workout()
  {
    return $this->hasMany(Workout::class, 'id', '');
  } 
}
