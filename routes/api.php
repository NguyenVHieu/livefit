<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\ExerciseController;
use App\Http\Controllers\Admin\GoalController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\WorkoutController;
use App\Http\Controllers\Admin\ExerciseDetailController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\BodyIndexController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\UserAnswerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PlanCategoryController;
use App\Http\Controllers\Admin\MuscleGroupController;
use App\Http\Controllers\Admin\TypeController;

Route::prefix('/admin')->group(function () {
  Route::prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
  });

  Route::prefix('levels')->group(function () {
    Route::get('/', [LevelController::class, 'index']);
    Route::post('/', [LevelController::class, 'store']);
    Route::get('/{id}', [LevelController::class, 'show']);
    Route::put('/{id}', [LevelController::class, 'update']);
    Route::delete('/{id}', [LevelController::class, 'destroy']);
  });

  Route::prefix('equipments')->group(function () {
    Route::get('/', [EquipmentController::class, 'index']);
    Route::post('/', [EquipmentController::class, 'store']);
    Route::get('/{id}', [EquipmentController::class, 'show']);
    Route::post('/{id}', [EquipmentController::class, 'update']);
    Route::delete('/{id}', [EquipmentController::class, 'destroy']);
  });

  Route::prefix('locations')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::post('/', [LocationController::class, 'store']);
    Route::get('/{id}', [LocationController::class, 'show']);
    Route::put('/{id}', [LocationController::class, 'update']);
    Route::delete('/{id}', [LocationController::class, 'destroy']);
  });

  Route::prefix('exercises')->group(function () {
    Route::get('/', [ExerciseController::class, 'index']);
    Route::post('/', [ExerciseController::class, 'store']);
    Route::get('/{id}', [ExerciseController::class, 'show']);
    Route::post('/{id}', [ExerciseController::class, 'update']);
    Route::delete('/{id}', [ExerciseController::class, 'destroy']);
  });

  Route::prefix('goals')->group(function () {
    Route::get('/', [GoalController::class, 'index']);
    Route::post('/', [GoalController::class, 'store']);
    Route::get('/{id}', [GoalController::class, 'show']);
    Route::put('/{id}', [GoalController::class, 'update']);
    Route::delete('/{id}', [GoalController::class, 'destroy']);
  });

  Route::prefix('plans')->group(function () {
    Route::get('/', [PlanController::class, 'index']);
    Route::post('/', [PlanController::class, 'store']);
    Route::get('/{id}', [PlanController::class, 'show']);
    Route::post('/{id}', [PlanController::class, 'update']);
    Route::delete('/{id}', [PlanController::class, 'destroy']);
  });

  Route::prefix('workouts')->group(function () {
    Route::get('/', [WorkoutController::class, 'index']);
    Route::post('/', [WorkoutController::class, 'store']);
    Route::get('/{id}', [WorkoutController::class, 'show']);
    Route::put('/{id}', [WorkoutController::class, 'update']);
    Route::delete('/{id}', [WorkoutController::class, 'destroy']);
  });

  Route::prefix('exercise_details')->group(function () {
    Route::get('/', [ExerciseDetailController::class, 'index']);
    Route::post('/', [ExerciseDetailController::class, 'store']);
    Route::get('/{id}', [ExerciseDetailController::class, 'show']);
    Route::put('/{id}', [ExerciseDetailController::class, 'update']);
    Route::delete('/{id}', [ExerciseDetailController::class, 'destroy']);
  });

  Route::prefix('foods')->group(function () {
    Route::get('/', [FoodController::class, 'index']);
    Route::post('/', [FoodController::class, 'store']);
    Route::get('/{id}', [FoodController::class, 'show']);
    Route::put('/{id}', [FoodController::class, 'update']);
    Route::delete('/{id}', [FoodController::class, 'destroy']);
  });

  Route::prefix('meals')->group(function () {
    Route::get('/', [MealController::class, 'index']);
    Route::post('/', [MealController::class, 'store']);
    Route::get('/{id}', [MealController::class, 'show']);
    Route::post('/{id}', [MealController::class, 'update']);
    Route::delete('/{id}', [MealController::class, 'destroy']);
  });

  Route::prefix('packages')->group(function () {
    Route::get('/', [PackageController::class, 'index']);
    Route::post('/', [PackageController::class, 'store']);
    Route::get('/{id}', [PackageController::class, 'show']);
    Route::put('/{id}', [PackageController::class, 'update']);
    Route::delete('/{id}', [PackageController::class, 'destroy']);
  });

  Route::prefix('schedules')->group(function () {
    Route::get('/', [ScheduleController::class, 'index']);
    Route::post('/', [ScheduleController::class, 'store']);
    Route::get('/{id}', [ScheduleController::class, 'show']);
    Route::put('/{id}', [ScheduleController::class, 'update']);
    Route::delete('/{id}', [ScheduleController::class, 'destroy']);
  });

  Route::prefix('body-indexs')->group(function () {
    Route::get('/', [BodyIndexController::class, 'index']);
    Route::post('/', [BodyIndexController::class, 'store']);
    Route::get('/{id}', [BodyIndexController::class, 'show']);
    Route::put('/{id}', [BodyIndexController::class, 'update']);
    Route::delete('/{id}', [BodyIndexController::class, 'destroy']);
  });

  Route::prefix('quizs')->group(function () {
    Route::get('/', [QuizController::class, 'index']);
    Route::post('/', [QuizController::class, 'store']);
    Route::get('/{id}', [QuizController::class, 'show']);
    Route::get('/list-answer/{id}', [QuizController::class, 'listAnswer']);
    Route::put('/{id}', [QuizController::class, 'update']);
    Route::delete('/{id}', [QuizController::class, 'destroy']);
  });

  Route::prefix('user_answers')->group(function () {
    Route::get('/', [UserAnswerController::class, 'index']);
    Route::post('/', [UserAnswerController::class, 'store']);
    Route::get('/{id}', [UserAnswerController::class, 'show']);
    Route::put('/{id}', [UserAnswerController::class, 'update']);
    Route::delete('/{id}', [UserAnswerController::class, 'destroy']);
  });

  Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
  });

  Route::prefix('plan-categories')->group(function () {
    Route::get('/', [PlanCategoryController::class, 'index']);
    Route::post('/', [PlanCategoryController::class, 'store']);
    Route::get('/{id}', [PlanCategoryController::class, 'show']);
    Route::put('/{id}', [PlanCategoryController::class, 'update']);
    Route::delete('/{id}', [PlanCategoryController::class, 'destroy']);
  });

  Route::prefix('muscle-group')->group(function () {
    Route::get('/', [MuscleGroupController::class, 'index']);
    Route::post('/', [MuscleGroupController::class, 'store']);
    Route::get('/{id}', [MuscleGroupController::class, 'show']);
    Route::post('/{id}', [MuscleGroupController::class, 'update']);
    Route::delete('/{id}', [MuscleGroupController::class, 'destroy']);
  });

  Route::prefix('types')->group(function () {
    Route::get('/', [TypeController::class, 'index']);
    Route::post('/', [TypeController::class, 'store']);
    Route::get('/{id}', [TypeController::class, 'show']);
    Route::post('/{id}', [TypeController::class, 'update']);
    Route::delete('/{id}', [TypeController::class, 'destroy']);
  });

  Route::group(['middleware' => 'api', 'prefix' => 'admins'], function ($router) {
    Route::post('/register', [AdminController::class, 'register']);
    Route::post('/login', [AdminController::class, 'login']);
    Route::get('/logout', [AdminController::class, 'logout']);
    Route::get('/list_admin', [AdminController::class, 'listAdmin']);
    Route::get('/profile', [AdminController::class, 'profile']);
    Route::post('/update-admin', [AdminController::class, 'updateAdmin']);
    Route::post('/delete-admin', [AdminController::class, 'destroy']);
  });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
