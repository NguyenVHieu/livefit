<?php

namespace App\Http\Controllers\Admin;

use App\Models\MuscleGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\Helpers\Helper;

class MuscleGroupController extends Controller
{
  public function index()
	{
		$data = MuscleGroup::paginate(10);
		return $this->response(200, $data);
	}

	public function store(Request $request)
	{
    $request->validate([
      'title' => 'required',
      'image' => 'image|mimes:jpeg,png|max:2048'
    ]);

    $file = $request->file('image');
		$file_name = $file->getClientOriginalName();
		$file->storeAs('public/uploads/images', $file_name);

    $muscle_image = Helper::upload_image($file_name);

		$data = ['title' => $request->title, 'image' => $muscle_image];
		MuscleGroup::create($data);
		
		return $this->response(200, $data);
	}

	public function show($id)
	{
		$data = MuscleGroup::find($id);
    if (!$data) return $this->response(400, "Not Found");
		return $this->response(200, $data);
	}

	public function update(Request $request, $id)
	{
    $request->validate([
      'image' => 'image|mimes:jpeg,png|max:2048'
    ]);

		$data = MuscleGroup::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $file_name = $data->image;
    
		if ($request->image) {
			$file = $request->file('image');
			$file_name = $file->getClientOriginalName();
			$file->storeAs('public/uploads/images', $file_name);
      Storage::delete('public/uploads/images/' . $data->image);
    }

    $muscle_image = Helper::upload_image($file_name);

		$empData = ['title' => $request->title, 'image' => $muscle_image];
		$data->update($empData);

		return $this->response(200, $data);
		
  }
	public function destroy($id)
	{
    $data = MuscleGroup::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $data->delete();
		Storage::delete('public/uploads/images' . $data->image);
		return $this->response(200);
	}
}
