<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Helpers\Helper;

class PlanController extends Controller
{
  public function index()
	{
		$data = Plan::paginate(10);
		return $this->response(200, $data);
	}

	public function store(Request $request)
	{
    $request->validate([
      'name' => 'required',
      'image' => 'required|image|mimes:jpeg,png|max:2048'
    ]);

    $image = $request->file('image');
		$file_image = $image->getClientOriginalName();
		$image->storeAs('public/uploads/images', $file_image);

    $plan_image = Helper::upload_image($file_image);
    
		$data = [
      'category_id' => $request->category_id,
      'price' => $request->price, 
      'name' => $request->name, 
      'slug' => SlugService::createSlug(Plan::class, 'slug', $request->name),
      'description' => $request->description,
      'instruction' => $request->instruction,
      'image' => $plan_image,
      'member' => $request->member,
      'time' => $request->time,
      'is_sell' => $request->is_sell,
      'calendar_exercises' => $request->calendar_exercises,
    ];

		$p = Plan::create($data);
    $plan = Plan::find($p->id);
    $plan->fhbLevel()->attach($request->get('level_id'));
    $plan->fhbGoal()->attach($request->get('goal_id'));
    $plan->fhbEquipment()->attach($request->get('equipment_id'));
    $plan->fhbLocation()->attach($request->get('location_id'));
    
		return $this->response(200, $data);
	}

	public function show($id)
	{
		$data = Plan::find($id);
    if (!$data) return $this->response(400, "Not Found");
		return $this->response(200, $data);
	}

	public function update(Request $request, $id)
	{
    $request->validate([
      'name' => 'required',
      'image' => 'required|image|mimes:jpeg,png|max:2048'
    ]);

		$data = Plan::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $file_image = $data->image;
    
		if ($request->image) {
			$image = $request->file('image');
			$file_image = $image->getClientOriginalName();
			$image->storeAs('public/uploads/images', $file_image);
      Storage::delete('public/uploads/images/' . $data->image);
    }

    $plan_image = Helper::upload_image($file_image);

		$plData = [
      'category_id' => $request->category_id,
      'price' => $request->price, 
      'name' => $request->name, 
      'slug' => SlugService::createSlug(Plan::class, 'slug', $request->name),
      'description' => $request->description,
      'instruction' => $request->instruction,
      'image' => $plan_image,
      'member' => $request->member,
      'time' => $request->time,
      'is_sell' => $request->is_sell,
      'calendar_exercises' => $request->calendar_exercises,
    ];

		$data->update($plData);

		return $this->response(200, $data);
		
  }
  
	public function destroy($id)
	{
    $data = Plan::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $data->delete();
		Storage::delete('public/uploads/images' . $data->image);
		return $this->response(200);
	}

  public function fhbSearchPlan(Request $request)
  {
    $keyword = $request->keyword;
    $plan = Plan::where('name', 'LIKE', '%'. $keyword.'%')->get();
		return $this->response(200, $plan);
  } 

  public function fhbNewPlan()
  {
    $data = Plan::all();
    dd($data);
		return $this->response(200, $data);
  }
}
