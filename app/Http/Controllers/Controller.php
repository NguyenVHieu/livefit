<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($code = 200, $data = null)
    {
      $result = [];
      switch($code) {
        case 400:
          $result['message'] = $data ?: 'Something went wrong';
          break;
        case 401:
          $result['message'] = $data ?: 'Authorization Error';
          break;
        case 404:
          $result['message'] = $data ?: 'Not found';
          break;
        case 422:
          $result['errors'] = $data;
          break;
        default:
          $result['message'] = 'Success';
          if ($data) $result['data'] = $data;
      }

      return response()->json($result, $code);

    }
}
