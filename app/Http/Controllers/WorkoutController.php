<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;
use Cviebrock\EloquentSluggable\Services\SlugService;


class WorkoutController extends Controller
{
  public function index()
  {
    $data = Workout::all();
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'plan_id' => 'required',
      'title' => 'required'
    ]);
   
    $data = [
      'plan_id' => $request->plan_id, 
      'user_id' => $request->user_id, 
      'title' => $request->title, 
      'slug' => SlugService::createSlug(Workout::class, 'slug', $request->title), 
      'description' => $request->description,
      'time' => $request->time,
    ];
    // error_log(json_encode($data));
		$item = Workout::create($data);
    return $this->response(200, $item);
  }

  public function detailWorkout(Request $request)
	{
    $slug = $request->slug;
    $workout = Workout::where('slug', $slug)->first();
    if (!$workout) return $this->response(400, "Not Found");
		return $this->response(200, $workout);
	}

  public function update(Request $request, $id)
  {
    $request->validate([
      'plan_id' => 'required'
    ]);

    $data = Workout::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->plan_id = $request->plan_id;
    $data->title = $request->title;
    $data->description = $request->description;
    $data->time = $request->time;
    $data->update();

    return $this->response(200);
  }

  public function fhbGetExercise($id)
  {
    $workout = Workout::where('id', $id)->with('exercise')->first();
    return $this->response(200, $workout);
  }

  public function destroy($id)
  {
    $data = Workout::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }

}
