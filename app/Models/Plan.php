<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Plan extends Model
{
  use HasFactory, Sluggable;
  protected $fillable = [
    'category_id',
    'price',
    'name',
    'slug',
    'member',
    'description',
    'instruction',
    'time',
    'image',
    'is_sell',
    'calendar_exercises'
  ];

  protected $casts = [
    'level' => 'array',
    'equipment' => 'array',
    'location' => 'array',
    'time' => 'array'
  ];

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }

  public function workout()
  {
    return $this->hasMany(Workout::class, 'plan_id');
  } 

  public function schedule()
  {
      return $this->hasMany(Schedule::class, 'plan_id');
  }
  
  public function fhbGoal()
  {
    return $this->belongsToMany(Goal::class, 'plan_goals', 'plan_id', 'goal_id');
  } 

  public function fhbLevel()
  {
    return $this->belongsToMany(Level::class, 'plan_levels', 'plan_id', 'level_id');
  } 

  public function fhbEquipment()
  {
    return $this->belongsToMany(Equipment::class, 'plan_equipments', 'plan_id', 'equipment_id');
  }

  public function fhbLocation()
  {
    return $this->belongsToMany(Location::class, 'plan_locations', 'plan_id', 'location_id');
  }

  public function fhbCategory()
  {
    return $this->belongsTo(PlanCategory::class, 'categories_id', 'id');
  }
}
