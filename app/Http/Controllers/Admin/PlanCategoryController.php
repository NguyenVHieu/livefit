<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlanCategory;
use Illuminate\Http\Request;

class PlanCategoryController extends Controller
{
  public function index()
  {
    $data = PlanCategory::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'name' => 'required',
    ]);
   
    $input = $request->all();
    $data = PlanCategory::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = PlanCategory::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'title' => 'required',
    ]);

    $data = PlanCategory::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->title = $request->title;
    $data->update();

    return $this->response(200);
  }

  public function destroy($id)
  {
    $data = PlanCategory::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }
}
