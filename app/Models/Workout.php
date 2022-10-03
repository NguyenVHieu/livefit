<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Workout extends Model
{
  use HasFactory, sluggable;
  protected $fillable = [
    'plan_id',
    'user_id',
    'title',
    'slug',
    'description',
    'time',
    'index'
  ];

  protected $casts = [
    'index' => 'array'
  ];

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }

  public function workoutDetail()
  {
    return $this->hasMany(ExerciseDetail::class, 'workout_id');
  } 
  
  public function schedule()
  {
    return $this->hasMany(Schedule::class, 'workout_id');
  } 

  public function exercise()
  {
    return $this->belongsToMany(Exercise::class, 'exercise_details', 'workout_id', 'exercise_id')->withPivot('set', 'rep', 'set_rest', 'exercise_rest', 'total_time');
  } 
}