<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Meal extends Model
{
  use HasFactory, Sluggable;
  protected $fillable = [
    'price',
    'title',
    'slug',
    'description',
    'ingredients',
    'category',
    'goal',
    'calories',
    'carbs',
    'protein',
    'fat',
    'time',
    'servings',
    'status',
    'image',
    'is_custom'
  ];

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'title'
      ]
    ];
  }

  public function user()
  {
    return $this->belongsToMany(User::class, 'user_meals', 'user_id', 'meal_id');
  } 
}
