<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
  public function index()
  {
    $data = Schedule::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'user_id' => 'required',
      'plan_id' => 'required',
      'workout_id' => 'required'
    ]);
   
    $input = $request->all();
    $data = Schedule::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = Schedule::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'user_id' => 'required',
      'plan_id' => 'required',
      'workout_id' => 'required'
    ]);

    $data = Schedule::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $scheData = [
        'user_id' => $request->user_id,
        'plan_id' => $request->plan_id,
        'workout_id'=> $request->workout_id,
        'date'=> $request->date,
        'index' => $request->index
    ];

    $data->update($scheData);

    return $this->response(200);
  }

  public function destroy($id)
  {
    $data = Schedule::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }
}
