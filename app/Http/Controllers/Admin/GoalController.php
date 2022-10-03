<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
  public function index()
  {
    $data = Goal::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'name' => 'required',
      'type' => 'required',
    ]);
   
    $input = $request->all();
    $data = Goal::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = Goal::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required',
      'type' => 'required',
    ]);

    $data = Goal::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->name = $request->name;
    $data->type = $request->type;
    $data->update();

    return $this->response(200);
  }

  public function destroy($id)
  {
    $data = Goal::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }
}
