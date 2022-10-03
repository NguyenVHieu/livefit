<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
  public function index()
  {
    $data = Quiz::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'question' => 'required',
    ]);
   
    $input = $request->all();
    $data = Quiz::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = Quiz::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'question' => 'required',
    ]);

    $data = Quiz::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $qData = [
        'question' => $request->question,
        'answer'=> $request->answer,
        'type'=> $request->type,
    ];

    $data->update($qData);

    return $this->response(200);
  }

  public function destroy($id)
  {
    $data = Quiz::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }

  public function listAnswer($id)
  {
    $data = Quiz::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data->answer);
  }
}
