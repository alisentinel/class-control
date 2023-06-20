<?php

namespace App\Traits;


trait ApiResponse
{
  protected function successResponse($code, $data, $message = null)
  {
    return response()->json(
      [
        "status" => 200,
        "data" => $data,
        "message" => $message,
      ],
      $code
    );
  }
  protected function errorResponse($code, $message = null)
  {
    return response()->json(
      [
        "status" => 400,
        "message" => $message,

      ],
      $code
    );
  }
}
