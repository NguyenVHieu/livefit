<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExerciseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ExerciseDetailController extends Controller
{
  public function index()
  {
    $data = ExerciseDetail::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'exercise_id' => 'required',
      'workout_id' => 'required',
    ]);
   
    $input = $request->all();
    $data = ExerciseDetail::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = ExerciseDetail::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
        'exercise_id' => 'required',
        'workout_id' => 'required',
    ]);

    $data = ExerciseDetail::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->exercise_id = $request->exercise_id;
    $data->workout_id = $request->workout_id;
    $data->set = $request->set;
    $data->rep = $request->rep;
    $data->set_rest = $request->set_rest;
    $data->exercise_rest = $request->exercise_rest;
    $data->update();

    return $this->response(200);
  }

  public function destroy($id)
  {
    $data = ExerciseDetail::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }
}
