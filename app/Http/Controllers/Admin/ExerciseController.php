<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;

class ExerciseController extends Controller
{
  public function index()
	{
		$data = Exercise::paginate(10);
		return $this->response(200, $data);
	}

	public function store(Request $request)
	{
    $request->validate([
      'title' => 'required',
      'image' => 'mimes:jpeg,png|max:2048',
      'video' => 'mimes:mp4,mov|max:20000'
    ]);

    if ($request->image) {
    $image = $request->file('image');
		$file_image = $image->getClientOriginalName();
		$image->storeAs('public/uploads/images', $file_image);
    $exercise_image = Helper::upload_image($file_image);
    }

    if ($request->video) {
    $video = $request->file('video');
		$file_video = $video->getClientOriginalName();
    $image->storeAs('public/uploads/videos', $file_video);
    $exercise_video = Helper::upload_video($file_video);
    }

		$data = [
      'title' => $request->title, 
      'description' => $request->description,
      'instruction' => $request->instruction,
      'image' => $exercise_image,
      'video' => $exercise_video,
      'tips' => $request->tips
    ];
		Exercise::create($data);
		
    $e = Exercises::create($data);
    $exercise = Exercises::find($e->id);
    $exercise->fhbLevel()->attach($request->get('level_id'));
    $exercise->fhbGoal()->attach($request->get('goal_id'));
    $exercise->fhbEquipment()->attach($request->get('equipment_id'));
    $exercise->fhbLocation()->attach($request->get('location_id'));
    $exercise->fhbType()->attach($request->get('type_id'));
    $exercise->fhbMuscle()->attach($request->get('muscle_id'));

		return $this->response(200, $data);
	}

	public function show($id)
	{
		$data = Exercise::find($id);
    if (!$data) return $this->response(400, "Not Found");
		return $this->response(200, $data);
	}

	public function update(Request $request, $id)
	{
    $request->validate([
      'title' => 'required',
      'image' => 'mimes:jpeg,png | max:2048',
      'video' => 'mimes:mp4,mov | max:20000'
    ]);

		$data = Exercise::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $file_image = $data->image;
    $file_video = $data->video;

		if ($request->image) {
			$image = $request->file('image');
			$file_image = $image->getClientOriginalName();
			$image->storeAs('public/uploads/images', $file_image);
      Storage::delete('public/uploads/images/' . $data->image);
      $exercise_image = Helper::upload_image($file_image);
    }
    
    if ($request->video) {
			$video = $request->file('video');
			$file_video = $video->getClientOriginalName();
			$video->storeAs('public/uploads/videos', $file_video);
      Storage::delete('public/uploads/videos/' . $data->video);
      $exercise_video = Helper::upload_video($file_video);
    }

		$exData = [
      'title' => $request->title, 
      'description' => $request->description,
      'instruction' => $request->instruction,
      'image' => $exercise_image,
      'video' => $exercise_video,
      'tips' => $request->tips
    ];

		$data->update($exData);

		return $this->response(200, $data);
		
  }

	public function destroy($id)
	{
    $data = Exercise::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $data->delete();
		Storage::delete('public/uploads/images/' . $data->image);
    Storage::delete('public/uploads/videos/' . $data->video);
		return $this->response(200);
	}
}
