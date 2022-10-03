<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ExerciseDetailController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MealController;

  Route::prefix('api/plans')->group(function () {
    Route::get('/', [PlanController::class, 'listPlan']);
    Route::get('/{slug}', [PlanController::class, 'detailPlan']);
    Route::get('/workouts/{id}', [PlanController::class, 'getWorkout']);
    Route::post('/filter-plan', [PlanController::class, 'fhbFilterPlan']);  
    Route::post('/search', [PlanController::class, 'fhbSearchPlan']);
    Route::post('/new-plan', [PlanController::class, 'fhbRelatedPlan']);
    Route::get('/workout-trainer/{id}', [PlanController::class, 'fhbGetScheduleTrainer']);
  });
  
  Route::group(['middleware' => 'api', 'prefix' => 'api/users'], function ($router) {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/update-profile', [UserController::class, 'updateProfile']);
    Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']); 
    Route::post('/send-email-verify', [UserController::class, 'sendEmailVerify']);
    Route::post('/verify-email', [UserController::class, 'emailVerify']);
    Route::get('/my-meal', [UserController::class, 'myMeal']);
    Route::get('/my-plan', [UserController::class, 'myPlan']);
    Route::get('/my-workout', [UserController::class, 'fhbMyWorkout']);
    Route::post('/add-my-workout', [UserController::class, 'fhbAddWorkout']);
    Route::post('/update-my-workout/{id}', [UserController::class, 'fhbUpdateWorkout']);
    Route::delete('/delete-my-workout/{id}', [UserController::class, 'fhbDeleteWorkout']);
    Route::get('/my-order', [UserController::class, 'fhbMyOrder']);
    Route::get('/my-order-detail/{id}', [UserController::class, 'fhbDetailOrder']);
    Route::get('/my-schedule', [UserController::class, 'fhbMySchedule']);
    Route::post('/add-my-schedule', [UserController::class, 'fhbAddSchedule']);
    Route::post('/update-my-schedule/{id}', [UserController::class, 'fhbUpdateSchedule']);
    Route::delete('/delete-my-schedule/{id}', [UserController::class, 'fhbDeleteSchedule']);
    Route::delete('/clear-my-schedule', [UserController::class, 'fhbClearCalendar']);
    Route::post('/add-my-client', [UserController::class, 'fhbAddClient']);
    Route::post('/my-client', [UserController::class, 'fhbGetClient']);
    Route::put('/update-my-client/{id}', [UserController::class, 'fhbUpdateClient']);
    Route::delete('/delete-my-client/{id}', [UserController::class, 'fhbDeleteClient']);
    Route::get('/plan-trainer', [UserController::class, 'fhbPlanTrainer']);
    Route::post('/add-plan-trainer', [UserController::class, 'fhbAddPlanTrainer']);
    Route::put('/update-plan-trainer/{id}', [UserController::class, 'fhbUpdatePlanTrainer']);
    Route::delete('/delete-plan-trainer/{id}', [UserController::class, 'fhbDeletePlanTrainer']);
  });

  Route::prefix('api/exercises')->group(function () {
    Route::get('/', [ExerciseController::class, 'index']);
    Route::post('/filter', [ExerciseController::class, 'fhbFilterExercise']);
    Route::get('/detail/{id}', [ExerciseController::class, 'fhbDetailExercise']);
    Route::post('/search', [ExerciseController::class, 'fhbSearchExercise']);
    Route::post('/filter-type', [ExerciseController::class, 'fhbFilter']);
  });

  Route::prefix('api/meals')->group(function () {
    Route::get('/', [MealController::class, 'index']);
    Route::post('/', [MealController::class, 'store']);
    Route::post('/{id}', [MealController::class, 'update']);
    Route::delete('/{id}', [MealController::class, 'destroy']);
    Route::get('/{slug}', [MealController::class, 'mealDetail']);
    });

  Route::prefix('api/workouts')->group(function () {
    Route::get('/', [WorkoutController::class, 'index']);
    Route::post('/', [WorkoutController::class, 'store']);
    Route::get('/{slug}', [WorkoutController::class, 'detailWorkout']);
    Route::put('/{id}', [WorkoutController::class, 'update']);
    Route::delete('/{id}', [WorkoutController::class, 'destroy']);
    Route::get('/exercises/{id}', [WorkoutController::class, 'fhbGetExercise']);
  });

  Route::prefix('api/orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
  });

Route::get('/{any}', [ApplicationController::class, 'index'])->where('any', '.*');
