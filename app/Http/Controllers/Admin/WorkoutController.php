<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
  public function index()
  {
    $data = Workout::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'plan_id' => 'required'
    ]);
   
    $input = $request->all();
    $data = Workout::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = Workout::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
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

  public function destroy($id)
  {
    $data = Workout::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }
}
