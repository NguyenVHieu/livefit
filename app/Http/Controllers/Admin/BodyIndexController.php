<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BodyIndex;
use Illuminate\Http\Request;

class BodyIndexController extends Controller
{
  public function index()
  {
    $data = BodyIndex::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'user_id' => 'required'
    ]);
   
    $input = $request->all();
    $data = BodyIndex::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = BodyIndex::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'user_id' => 'required'
    ]);

    $data = BodyIndex::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $bodyData = [
        'user_id' => $request->user_id,
        'date' => $request->date,
        'height' => $request->height,
        'weight' => $request->weight,
        'exercise_intansity' => $request->exercise_intansity,
        'bmi' => $request->bmi,
        'bmr' => $request->bmr,
        'tdee'=> $request->tdee,
        'marco'=> $request->marco,
    ];

    $data->update($bodyData);

    return $this->response(200);
  }

    public function destroy($id)
    {
      $data = BodyIndex::find($id);
      if (!$data) return $this->response(400, "Not Found");
      $data->delete();
      return $this->response(200);
    }
}
