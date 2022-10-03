<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
  use HasFactory;
  protected $fillable = [
    'title',
    'gender',
    'description',
    'instruction',
    'cover_female',
    'image',
    'cover_male',
    'video',
    'tips'
  ];
    
  public function exerciseDetail()
  {
    return $this->hasOne(ExerciseDetail::class, 'exercise_id');
  }
  
  public function fhbGoal()
  {
    return $this->belongsToMany(Goal::class, 'exercise_goals', 'exercise_id', 'goal_id');
  } 

  public function fhbType()
  {
    return $this->belongsToMany(Type::class, 'exercise_types', 'exercise_id', 'type_id');
  } 

  public function fhbLevel()
  {
    return $this->belongsToMany(Level::class, 'exercise_levels', 'exercise_id', 'level_id');
  } 

  public function fhbEquipment()
  {
    return $this->belongsToMany(Equipment::class, 'exercise_equipments', 'exercise_id', 'equipment_id');
  } 

  public function fhbLocation()
  {
    return $this->belongsToMany(Location::class, 'exercise_locations', 'exercise_id', 'location_id');
  } 

  public function fhbMuscle()
  {
    return $this->belongsToMany(MuscleGroup::class, 'exercise_muscles', 'exercise_id', 'muscle_id')->withPivot('type');
  } 
}
