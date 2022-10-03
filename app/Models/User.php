<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
  use HasApiTokens, HasFactory, Notifiable;
  protected $hidden = ['password','forgot_password_token','remember_token'];
  protected $primaryKey = 'id';
  protected $fillable = [
    'username',
    'name',
    'email',
    'password',
    'birthday',
    'gender',
    'address',
    'is_trainer',
    'trainer_id',
    'referral_id',
    'email_verified_at',
    'phone_verified_at',
    'body_index',
    'packages',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
    'phone_verified_at' => 'datetime',
    'body_index' => 'array',
    'package' => 'array'
  ];

// Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

  public function body()
  {
    return $this->hasMany(BodyIndex::class, 'user_id');
  } 

  public function order()
  {
    return $this->hasMany(Order::class, 'user_id');
  } 

  public function schedule()
  {
    return $this->hasMany(Schedule::class, 'user_id');
  } 

  public function userAnswer()
  {
    return $this->belongsToMany(Quiz::class, 'user_answers', 'user_id', 'question_id');
  } 
    
  public function plan()
  {
    return $this->belongsToMany(Plan::class, 'user_plans', 'user_id', 'plan_id');
  } 

  public function meal()
  {
    return $this->belongsToMany(Meal::class, 'user_meals', 'user_id', 'meal_id');
  } 

  public function fhbWorkout()
  {
    return $this->hasMany(Workout::class, 'user_id');
  }
}
