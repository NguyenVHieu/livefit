<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class UserAnswerController extends Controller
{
  public function index()
  {
    $data = UserAnswer::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'user_id' => 'required',
      'question_id' => 'required'
    ]);
   
    $input = $request->all();
    $data = UserAnswer::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = UserAnswer::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
        'user_id' => 'required',
        'question_id' => 'required'
    ]);

    $data = UserAnswer::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $userData = [
        'user_id' => $request->user_id,
        'question_id' => $request->question_id,
        'answer'=> $request->answer,
        'datetime'=> $request->datetime,
    ];

    $data->update($userData);

    return $this->response(200);
  }

  public function destroy($id)
  {
    $data = UserAnswer::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }
}
