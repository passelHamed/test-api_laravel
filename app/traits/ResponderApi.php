<?php

namespace App\Traits;

trait ResponderApi {

    public function api_response($statusCode = 200, $message = '', $data = []) {

      return response()->json([
        'message' => $message,
        'data' => $data
      ], $statusCode);

    }
}