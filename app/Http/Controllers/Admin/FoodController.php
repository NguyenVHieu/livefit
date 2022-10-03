<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
  public function index()
  {
    $data = Food::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'name' => 'required',
    ]);
   
    $input = $request->all();
    $data = Food::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = Food::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'name' => 'required',
    ]);

    $data = Food::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $data->name = $request->name;
    $data->category = $request->category;
    $data->goal = $request->goal;
    $data->calories = $request->calories;
    $data->carbs = $request->carbs;
    $data->protein = $request->protein;
    $data->fat = $request->fat;
    $data->servings = $request->servings;
    $data->data = $request->data;

    $data->update();

    return $this->response(200);
  }

  public function destroy($id)
  {
    $data = Food::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }
}
