<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
  public function index()
	{
		$data = Type::paginate(10);
		return $this->response(200, $data);
	}

	public function store(Request $request)
	{
    $request->validate([
      'title' => 'required'
    ]);

		$data = ['title' => $request->title];
		Type::create($data);
		
		return $this->response(200, $data);
	}

	public function show($id)
	{
		$data = Type::find($id);
    if (!$data) return $this->response(400, "Not Found");
		return $this->response(200, $data);
	}

	public function update(Request $request, $id)
	{
    $request->validate([
      'title' => 'required'
    ]);

		$data = Type::find($id);
    if (!$data) return $this->response(400, "Not Found");

		$empData = ['title' => $request->title];
		$data->update($empData);

		return $this->response(200, $data);
		
  }
	public function destroy($id)
	{
    $data = Type::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
		return $this->response(200);
	}
}
