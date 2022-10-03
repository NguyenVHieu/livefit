<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
	public function index()
	{
		$data = Equipment::paginate(10);
		return $this->response(200, $data);
	}

	public function store(Request $request)
	{
    $request->validate([
      'image' => 'image|mimes:jpeg,png|max:2048'
    ]);

    $file = $request->file('image');
		$file_name = $file->getClientOriginalName();
		$file->storeAs('public/uploads/images', $file_name);

		$data = ['title' => $request->title, 'image' => $file_name];
		Equipment::create($data);
		
		return $this->response(200, $data);
	}

	public function show($id)
	{
		$data = Equipment::find($id);
    if (!$data) return $this->response(400, "Not Found");
		return $this->response(200, $data);
	}

	public function update(Request $request, $id)
	{
    $request->validate([
      'image' => 'image|mimes:jpeg,png|max:2048'
    ]);

		$data = Equipment::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $file_name = $data->image;
    
		if ($request->image) {
			$file = $request->file('image');
			$file_name = $file->getClientOriginalName();
			$file->storeAs('public/uploads/images', $file_name);
      Storage::delete('public/uploads/images/' . $data->image);
    }
		$empData = ['title' => $request->title, 'image' => $file_name];
		$data->update($empData);

		return $this->response(200, $data);
		
  }
	public function destroy($id)
	{
    $data = Equipment::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $data->delete();
		Storage::delete('public/uploads/images' . $data->image);
		return $this->response(200);
	}
}
