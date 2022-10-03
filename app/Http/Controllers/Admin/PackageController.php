<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
      $data = Package::paginate(10);
      return $this->response(200, $data);
    }
  
    public function store(Request $request)
    {
      $request->validate([            
        'title' => 'required',
        'price' => 'required'
      ]);
     
      $input = $request->all();
      $data = Package::create($input);
      return $this->response(200, $data);
    }
  
    public function show($id)
    {
      $data = Package::find($id);
      if (!$data) return $this->response(400, "Not Found");
      return $this->response(200, $data);
    }
  
    public function update(Request $request, $id)
    {
      $request->validate([
        'title' => 'required',
        'price' => 'required'
      ]);
  
      $data = Package::find($id);
      if (!$data) return $this->response(400, "Not Found");
      $data->title = $request->title;
      $data->price = $request->price;
      $data->day = $request->day;
      $data->client = $request->client;
      $data->update();
  
      return $this->response(200);
    }
  
    public function destroy($id)
    {
      $data = Package::find($id);
      if (!$data) return $this->response(400, "Not Found");
      $data->delete();
      return $this->response(200);
    }
}
