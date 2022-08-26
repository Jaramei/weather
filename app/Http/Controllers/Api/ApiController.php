<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use \Illuminate\Http\JsonResponse;

class ApiController extends Controller
{

    /**
     * @param $result
     * @param $message
     * @return JsonResponse
     */
    public function sendResponse($result, $message): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404) : JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages))
        {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);

    }

}
