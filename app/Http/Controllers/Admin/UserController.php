<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
  public function index()
  {
    $data = User::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'username' => 'required',
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required'
    ]);
   
    $input = $request->all();
    $data = User::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = User::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'username' => 'required',
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required'
    ]);

    $data = User::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $userData = [
      'username' => $request->username,
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'birthday' => $request->birthday,
      'gender' => $request->gender,
      'address' => $request->address,
      'is_trainer'=> $request->is_trainer,
      'referral_id'=> $request->referral_id,
      'email_verified_at' => $request->email_verified_at,
      'phone_verified_at' => $request->phone_verified_at,
      'meal_ids' => $request->meal_ids,
      'body_index'=> $request->body_index,
      'packages'=> $request->packages,
  ];

    $data->update($userData);

    return $this->response(200);
  }

  public function destroy($id)
  {
    $data = User::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }
}
