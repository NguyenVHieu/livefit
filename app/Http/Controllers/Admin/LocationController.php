<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
	public function index()
	{
		$data = Location::paginate(10);
		return $this->response(200, $data);
	}

	public function store(Request $request)
	{
		$request->validate([            
			'title' => 'required'
		]);
   
		$input = $request->all();
		$data = Location::create($input);
		return $this->response(200, $data);
	}

	public function show($id)
	{
		$data = Location::find($id);
		if (!$data) return $this->response(400, "Not Found");
		return $this->response(200, $data);
	}

	public function update(Request $request)
	{
		$request->validate([
			'title' => 'required',
		]);

		$data = Location::find($request->id);
		if (!$data) return $this->response(400, "Not Found");

		$data->title = $request->title;
		$data->update();

		return $this->response(200);
	}

	public function destroy($id)
	{
		$data = Location::find($id);
		if (!$data) return $this->response(400, "Not Found");
		$data->delete();
		return $this->response(200);
	}
}
