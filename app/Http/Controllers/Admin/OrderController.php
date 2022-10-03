<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function index()
  {
    $data = Order::paginate(10);
    return $this->response(200, $data);
  }

  public function store(Request $request)
  {
    $request->validate([            
      'user_id' => 'required'
    ]);
   
    $input = $request->all();
    $data = Order::create($input);
    return $this->response(200, $data);
  }

  public function show($id)
  {
    $data = Order::find($id);
    if (!$data) return $this->response(400, "Not Found");
    return $this->response(200, $data);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
        'user_id' => 'required'
    ]);

    $data = Order::find($id);
    if (!$data) return $this->response(400, "Not Found");

    $orderData = [
      'datetime' => $request->datetime,
        'discount' => $request->discount,
        'total_payment' => $request->total_payment,
        'paygate' => $request->paygate,
        'status' => $request->status,
        'user_id' => $request->user_id,
        'object' => $request->object,
        'object_id' => $request->object_id,
        'notes' => $request->notes,
        'referral_code' => $request->referral_code,
        'trainer_id' => $request->trainer_id
    ];

    $data->update($orderData);

    return $this->response(200);
  }

  public function destroy($id)
  {
    $data = Order::find($id);
    if (!$data) return $this->response(400, "Not Found");
    $data->delete();
    return $this->response(200);
  }
}
