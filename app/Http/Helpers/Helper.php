<?php

namespace App\Http\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;

class Helper
{
    public static function sendError($message, $errors = [], $code = 401)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if (!empty($errors)) {
            $response['data'] = $errors;
        }

        throw new HttpResponseException(
            response()->json($response, $code)
        );
    }

    /*
        Success response
    */
    public static function successResponse($message, $data, $code = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return  response()->json($response, $code);
    }
}
