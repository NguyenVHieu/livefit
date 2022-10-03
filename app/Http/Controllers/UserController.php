<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workout;
use App\Models\Schedule;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Mail;
use URL;
use Str;
use App\Mail\ForgotPasswordMail;
use App\Mail\EmailVerification;
use Cviebrock\EloquentSluggable\Services\SlugService;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword', 'resetPassword', 'emailVerify', 'sendEmailVerify']]);
  }

  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => ['required', 'min:6', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[A-Z]/'],
      'password_confirm' => ['required', 'same:password', 'min:6', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[A-Z]/'],
      'gender' => 'required'
    ]);

    $data = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'gender' => $request->gender
    ]);
    $credentials = request(['email', 'password']);
    $token = auth()->attempt($credentials);
    return $this->respondWithToken($token);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => ['required', 'min:6', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[A-Z]/']
    ]);
    $credentials = request(['email', 'password']);

    if (!$token = auth()->attempt($credentials)) return $this->response(401, "Unauthorized");

    return $this->respondWithToken($token);
  }

  public function profile()
  {
    return $this->response(200, auth()->user());
  }

  public function updateProfile(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'gender' => 'required'
    ]);

    $data = auth()->user();

    if (!$data) return $this->response(400, "Not Found");

    $userData = [
      'username' => $request->username,
      'name' => $request->name,
      'email' => $request->email,
      'birthday' => $request->birthday,
      'gender' => $request->gender,
      'address' => $request->address,
      'is_trainer' => $request->is_trainer,
      'referral_id' => $request->referral_id,
      'email_verified_at' => $request->email_verified_at,
      'phone_verified_at' => $request->phone_verified_at,
      'meal_ids' => $request->meal_ids,
      'body_index' => $request->body_index,
      'packages' => $request->packages,
    ];

    if ($request->password) {
      $userData['password'] = Hash::make($request->password);
    }

    $data->update($userData);

    return $this->response(200);
  }

  public function logout()
  {
    auth()->logout();
    return $this->response(200);
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'message' => 'success',
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60000,
    ]);
  }

  public function refresh()
  {
    return $this->respondWithToken(auth()->refresh());
  }

  public function forgotPassword(Request $request)
  {
    $request->validate([
      'email' => 'required|email'
    ]);
    $user = User::where('email', $request->email)->first();
    if (!$user) return $this->response(400, "Not Found");

    $token = $user->id . Str::random(10);
    $domain = URL::to('/');
    $url = $domain . '/api/users/reset-password?token=' . $token;
    $data['url'] = $url;

    User::where('email', $request->email)->update(['forgot_password_token' => $token]);

    Mail::to($user)->send(new ForgotPasswordMail($data, $token));
    return $this->response(200, "Please check email");
  }

  public function resetPassword(Request $request)
  {
    $request->validate([
      'password' => ['required', 'confirmed', 'min:6', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[A-Z]/'],
    ]);
    $token = $request->token;
    $password = Hash::make($request->password);
    User::where('forgot_password_token', $request->token)->update(['password' => $password]);
    return $this->response(200);
  }

  public function sendEmailVerify(Request $request)
  {
    $request->validate([
      'email' => 'required|email'
    ]);
    $user = User::where('email', $request->email)->first();
    if (!$user) return $this->response(400, "Not Found");

    $check = $user['email_verified_at'];

    if ($check) return $this->response(400, "Email already verify!");

    $email_verified_code = $user->id . Str::random(10);
    $domain = URL::to('/');
    $url = $domain . '/api/users/verify-email?email_verified_code=' . $email_verified_code;
    $data['url'] = $url;

    User::where('email', $request->email)->update(['verify_email_code' => $email_verified_code]);
    Mail::to($user)->send(new EmailVerification($data, $email_verified_code));
    return $this->response(200, "Please check email");
  }

  public function emailVerify(Request $request)
  {
    $email_verified_code = $request->email_verified_code;
    $email_verified_at = \Carbon\Carbon::now();
    User::where('verify_email_code',  $email_verified_code)->update(['email_verified_at' => $email_verified_at]);
    return $this->response(200);
  }

  public function myMeal()
  {
    $meal = Auth::user('id')->meal()->get();
    return $this->response(200, $meal);
  }

  public function myPlan()
  {
    $plan = Auth::user('id')->plan()->with('fhbEquipment', 'fhbLevel')->get();
    return $this->response(200, $plan);
  }

  public function fhbMyWorkout()
  {
    $workout = Auth::user('id')->fhbWorkout()->with('exercise')->get();
    return $this->response(200, $workout);
  }

  public function fhbAddWorkout(Request $request)
  {
    $workout = Auth::user('id')->fhbWorkout()->create([
      'plan_id' => $request->plan_id,
      'title' => $request->title,
      'slug' => SlugService::createSlug(Workout::class, 'slug', $request->title),
      'description' => $request->description,
      'time' => $request->time,
    ]);
    foreach ($request->exercises as $exercise) {
      $id = $exercise['exercise_id'];
      $workout->exercise()->attach($id, [
        'set' => $exercise['set'],
        'rep' => $exercise['rep'],
        'set_rest' => $exercise['set_rest'],
        'exercise_rest' => $exercise['exercise_rest'],
        'total_time' => $exercise['set'] +  $exercise['rep'] + $exercise['rep']
      ]);
    }
    return $this->response(200, $workout);
  }

  public function fhbUpdateWorkout(Request $request, $id)
  {
    $workout = Auth::user('id')->fhbWorkout()->where('id', '=', $id)->update([
      'plan_id' => $request->plan_id,
      'title' => $request->title,
      'slug' => SlugService::createSlug(Workout::class, 'slug', $request->title),
      'description' => $request->description,
      'time' => $request->time,
    ]);
    $data = Workout::find($id);
    $data->exercise()->detach();
    foreach ($request->exercises as $exercise) {
      $exercise_id = $exercise['exercise_id'];
      $item = $data->exercise()->attach($exercise_id, [
        'set' => $exercise['set'],
        'rep' => $exercise['rep'],
        'set_rest' => $exercise['set_rest'],
        'exercise_rest' => $exercise['exercise_rest'],
        'total_time' => $exercise['set'] +  $exercise['rep'] + $exercise['rep'] //! FIXXXXXX

      ]);
    }
    return $this->response(200);
  }

  public function fhbDeleteWorkout($id)
  {
    $data = Workout::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    $schedule = Auth::user('id')->schedule()->where('workout_id', $id);
    if ($schedule) $schedule->delete();
    return $this->response(200);
  }

  public function fhbMyOrder()
  {
    $order = Auth::user('id')->order()->get();
    return $this->response(200, $order);
  }

  public function fhbDetailOrder($order_id)
  {
    $order = Auth::user('id')->order()->where('orders.id', '=', $order_id)->get();
    return $this->response(200, $order);
  }

  public function fhbMySchedule()
  {
    $schedule = Auth::user('id')->schedule()
      ->join('workouts', 'workouts.id', '=', 'schedules.workout_id')
      ->select('schedules.*', 'workouts.title', 'workouts.slug', 'workouts.index')
      ->get();
    return $this->response(200, $schedule);
  }

  public function fhbAddSchedule(Request $request)
  {
    $workout = Auth::user('id')->fhbWorkout()->create([
      'plan_id' => $request->plan_id,
      'title' => $request->title,
      'slug' => SlugService::createSlug(Workout::class, 'slug', $request->title),
      'description' => $request->description,
      'time' => $request->time
    ]);

    $workout_id = $workout->id;
    $plan_id = $workout->plan_id;

    foreach ($request->exercises as $exercise) {
      $id = $exercise['exercise_id'];
      $workout->exercise()->attach($id, [
        'set' => $exercise['set'],
        'rep' => $exercise['rep'],
        'set_rest' => $exercise['set_rest'],
        'exercise_rest' => $exercise['exercise_rest'],
        'total_time' => $exercise['set'] +  $exercise['rep'] + $exercise['rep'] //FIX
      ]);
    }

    $schedule = Auth::user('id')->schedule()->create([
      'plan_id' => $plan_id,
      'workout_id' => $workout_id,
      'date' => $request->date
    ]);
    return $this->response(200, $schedule);
  }

  public function fhbUpdateSchedule(Request $request, $id)
  {
    $workout = Auth::user('id')->fhbWorkout()->where('id', '=', $id)->update([
      'plan_id' => $request->plan_id,
      'title' => $request->title,
      'slug' => SlugService::createSlug(Workout::class, 'slug', $request->title),
      'description' => $request->description,
      'time' => $request->time,
    ]);

    $workout_id = $workout->id;
    $plan_id = $workout->plan_id;
    $workout->exercise()->detach();

    foreach ($request->exercises as $exercise) {
      $exercise_id = $exercise['exercise_id'];
      $workout->exercise()->attach($exercise_id, [
        'set' => $exercise['set'],
        'rep' => $exercise['rep'],
        'set_rest' => $exercise['set_rest'],
        'exercise_rest' => $exercise['exercise_rest'],
        'total_time' => $exercise['set'] +  $exercise['rep'] + $exercise['rep'] // FIX

      ]);
    }

    $schedule = Auth::user('id')->schedule()->where('workout_id', $id)->update([
      'plan_id' => $plan_id,
      'workout_id' => $workout_id,
      'date' => $request->date
    ]);
    return $this->response(200);
  }

  public function fhbDeleteSchedule($id)
  {
    $data = Workout::find($id);
    $schedule = Auth::user('id')->schedule()->where('workout_id', $id)->first();
    if (!$data || !$schedule) return $this->response(400, "Not Found");
    $data->delete();
    $schedule->delete();
    return $this->response(200);
  }

  public function fhbClearCalendar()
  {
    $schedule = Auth::user('id')->schedule()->delete();
    return $this->response(200);
  }

  public function fhbGetClient(Request $request)
  {
    $is_trainer = auth()->user()->is_trainer;
    if ($is_trainer == 1) {
      $trainer_id = $request->trainer_id;
      $client = User::where('trainer_id', $trainer_id)->get();
      return $this->response(200, $client);
    }
    return $this->response(400, "You not trainer, please buy package to trainer");
  }

  public function fhbAddClient(Request $request)
  {
    $is_trainer = auth()->user()->is_trainer;
    if ($is_trainer == 1) {
      $request->validate([
        'name' => 'required',
        'email' => 'required||email||unique:users',
        'password' => ['required', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/'],
        'password_confirm' => ['required', 'same:password'],
        'gender' => 'required',
        'trainer_id' => 'required'
      ]);

      $client = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'gender' => $request->gender,
        'trainer_id' => $request->trainer_id
      ]);

      return $this->response(200, $client);
    }
    return $this->response(400, "You not trainer");
  }

  public function fhbUpdateClient(Request $request, $id)
  {
    $is_trainer = auth()->user()->is_trainer;
    if ($is_trainer == 1) {
      $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'gender' => 'required'
      ]);

      $data = User::find($id);
      if (!$data) return $this->response(400, "Not Found");

      $userData = [
        'username' => $request->username,
        'name' => $request->name,
        'email' => $request->email,
        'birthday' => $request->birthday,
        'gender' => $request->gender,
        'address' => $request->address,
      ];

      if ($request->password) {
        $userData['password'] = Hash::make($request->password);
      }

      $data->update($userData);

      return $this->response(200);
    }
    return $this->response(400, "You not trainer, please buy package to trainer");
  }

  public function fhbDeleteClient($id)
  {
    $is_trainer = auth()->user()->is_trainer;
    if ($is_trainer == 1) {
      $client = User::find($id);
      if (!$client) return $this->response(400, "Not Found");
      $client->delete();
      return $this->response(200);
    }
    return $this->response(400, "You not trainer, please buy package to trainer");
  }

  public function fhbPlanTrainer()
  {
    $is_trainer = auth()->user()->is_trainer;
    if ($is_trainer == 1) {
      $plan = Auth::user('id')->plan()->get();
      return $this->response(200, $plan);
    }
    return $this->response(400, "You not trainer, please buy package to trainer");
  }

  public function fhbAddPlanTrainer(Request $request)
  {
    $is_trainer = auth()->user()->is_trainer;
    if ($is_trainer == 1) {
      $plan = Auth::user('id')->plan()->create([
        'name' => $request->name,
        'number_week' => $request->number_week
      ]);
      return $this->response(200, $plan);
    }
    return $this->response(400, "You not trainer, please buy package to trainer");
  }

  public function fhbUpdatePlanTrainer(Request $request, $id)
  {
    $is_trainer = auth()->user()->is_trainer;
    if ($is_trainer == 1) {
      $plan = Auth::user('id')->plan()->where('plans.id', $id)->update([
        'name' => $request->name,
        'number_week' => $request->number_week
      ]);
      return $this->response(200);
    }
    return $this->response(400, "You not trainer, please buy package to trainer");
  }

  public function fhbDeletePlanTrainer($id)
  {
    $is_trainer = auth()->user()->is_trainer;
    if ($is_trainer == 1) {
      $plan = Auth::user('id')->plan()->where('plans.id', $id);
      if (!$plan) return $this->response(400, "Not Found");
      $plan->delete();
      $plan->detach($id);
      return $this->response(200);
    }
    return $this->response(400, "You not trainer, please buy package to trainer");
  }
}
