<?php


namespace App\Helpers;


use Illuminate\Http\JsonResponse;

class GlobalHelpers
{
    /**
     * Returning json response to the Controller.
     *
     * @param array $data
     *
     * @return JsonResponse
     */
    public static function jsonResponse(array $data): JsonResponse
    {
        return response()->json($data);
    }
}
