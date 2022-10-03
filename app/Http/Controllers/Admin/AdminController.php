<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Config;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin', ['except' => ['listAdmin', 'login', 'register', 'updateAdmin']]);
  }

  public function listAdmin()
  {
    $admin = Admin::paginate(10);
    return $this->response(200, $admin);
  }

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(),[
        'username' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required'
      ]);
      $data = Admin::create(array_merge(
        $validator->validated(),
        ['password' => Hash::make($request->password)]
      ));
      return $this->response(200, $data);  
    }

  public function login()
  {
    $credentials = request(['email', 'password']);

    if (! $token = auth()->guard('admin')->attempt($credentials)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }

  public function profile()
  {
    return response()->json(auth()->user());
  }

  public function updateAdmin(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'username' => 'required',
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required'
    ]);

    $data=auth()->guard('admin')->user();
    if (!$data) return $this->response(400, "Not Found");

    $adData = [
      'name' => $request->name,
      'email' => $request->email,
      'username' => $request->username,
      'password' => Hash::make($request->password),
      'role' => $request->role
  ];

  $data->update($adData);

    return $this->response(200);
  }

  public function logout()
  {
    auth()->logout();

    return response()->json(['message' => 'Successfully logged out']);
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60,
    ]);
  }

  public function refresh()
  {
    return $this->respondWithToken(auth()->refresh());
  }

  public function destroy()
  {
    $admin=auth()->user();
    $admin->delete();
    return $this->response(200);
  }
}