<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class MealController extends Controller
{
  public function index()
	{
		$data = Meal::all();
		return $this->response(200, $data);
	}

	public function store(Request $request)
	{
    $request->validate([
      'title' => 'required',
      'image' => 'image|mimes:jpeg,png|max:2048'
    ]);

    $image = $request->file('image');
		$file_image = $image->getClientOriginalName();
		$image->storeAs('public/uploads/images', $file_image);
    
		$data = [
      'price' => $request->price,
      'title'=> $request->title,
      'slug' => SlugService::createSlug(Plan::class, 'slug', $request->title), 
      'description'=> $request->description,
      'ingredients'=> $request->ingredients,
      'category'=> $request->category,
      'goal'=> $request->goal,
      'calories'=> $request->calories,
      'carbs'=> $request->carbs,
      'protein' => $request->protein,
      'fat' => $request->fat,
      'time' => $request->time,
      'servings' => $request->servings,
      'status' => $request->status,
      'image' => $file_image,
      'is_custom' => $request->is_custom
    ];
		Meal::create($data);
		
		return $this->response(200, $data);
	}

	public function mealDetail(Request $request)
	{
    $slug = $request->slug;
    $meal = Meal::where('slug', $slug)->first();
    if (!$meal) return $this->response(400, "Not Found");
		return $this->response(200, $meal);
	}

	public function update(Request $request, $id)
	{
    $request->validate([
      'title' => 'required',
      'image' => 'image|mimes:jpeg,png|max:2048'
    ]);

		$data = Meal::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $file_image = $data->image;
    
		if ($request->image) {
			$image = $request->file('image');
			$file_image = $image->getClientOriginalName();
			$image->storeAs('public/uploads/images', $file_image);
      Storage::delete('public/uploads/images/' . $data->image);
    }
		$mData = [
      'price' => $request->price,
      'title'=> $request->title,
      'slug' => SlugService::createSlug(Plan::class, 'slug', $request->title), 
      'description'=> $request->description,
      'ingredients'=> $request->ingredients,
      'category'=> $request->category,
      'goal'=> $request->goal,
      'calories'=> $request->calories,
      'carbs'=> $request->carbs,
      'protein' => $request->protein,
      'fat' => $request->fat,
      'time' => $request->time,
      'servings' => $request->servings,
      'status' => $request->status,
      'image' => $file_image,
      'is_custom' => $request->is_custom
    ];

		$data->update($mData);

		return $this->response(200, $data);
  }
  
	public function destroy($id)
	{
    $data = Meal::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $data->delete();
		Storage::delete('public/uploads/images' . $data->image);
		return $this->response(200);
	}
}
