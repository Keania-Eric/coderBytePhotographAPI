<?php
namespace App\Traits;

use Illuminate\Http\Response;


trait ApiResponder 
{
    /**
     * Build success response
     * @param  string|array $data
     * @param  int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * Build valid response
     * @param  string|array $data
     * @param  int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function validResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Build error responses
     * @param  string|array $message
     * @param  int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
     * Build error responses
     * @param  string|array $message
     * @param  int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function errorMessage($message, $code)
    {
        $message = app()->environment() == 'production' ? 'An Unkwon error occurred' : $message;
        return response()->json($message, $code)->header('Content-Type', 'application/json');
    }
}