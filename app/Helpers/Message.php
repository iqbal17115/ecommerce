<?php


namespace App\Helpers;

use App\Enums\LogKeyEnums;
use App\Exceptions\CustomException;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Message
{
    /**
     * Return a new JsonResponse object with the given results and HTTP code.
     *
     * @param $results
     * @param int $code
     * @return JsonResponse
     */
    public static function jsonResponse($results = null, int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse($results, $code);
    }

    /**
     * Return a new JsonResponse object for an error message with the provided message, HTTP code, and error key.
     *
     * @param null $message
     * @param int $code
     * @param string|null $key
     * @return JsonResponse
     */
    public static function error($message = null, int $code = Response::HTTP_BAD_REQUEST, string $key = null): JsonResponse
    {
        // Create and return the JsonResponse with the appropriate data
        return new JsonResponse([
            'key' => $key ?? LogKeyEnums::BAD_REQUEST,
            'message' => $message ?? __("message.something_wrong_here"),
            'timestamp' => Carbon::now()->toDateTimeString(),
        ], $code == 0 ? Response::HTTP_BAD_REQUEST : $code);
    }

    /**
     * Return a new JsonResponse object for a success message with the provided message, results, HTTP code, and success key.
     *
     * @param null $message
     * @param null $results
     * @param int $code
     * @param string|null $key
     * @return JsonResponse
     */
    public static function success($message = null, $results = null, int $code = Response::HTTP_OK, string $key = null): JsonResponse
    {
        return new JsonResponse([
            'key' => $key ?? LogKeyEnums::SUCCESS,
            'message' => $message ?? __("message.executed_successfully"),
            'results' => $results,
            'timestamp' => Carbon::now()->toDateTimeString()
        ], $code);
    }

    /**
     * Return a new JsonResponse object for a validation error with the provided errors, message, and HTTP code.
     *
     * @param null $message
     * @param null $errors
     * @param int $code
     * @param string|null $key
     * @return JsonResponse
     */
    public static function validation($message = null, $errors = null, int $code = Response::HTTP_UNPROCESSABLE_ENTITY, string $key = null): JsonResponse
    {
        return new JsonResponse([
            'key' => $key ?? LogKeyEnums::VALIDATION,
            'message' => $message ?? __("message.something_wrong_here"),
            'errors' => $errors,
            'timestamp' => Carbon::now()->toDateTimeString()
        ], $code);
    }

    /**
     * Throw an Exception with the message extracted from the provided exception object, or from the string itself.
     *
     * @param $exception
     * @return mixed
     * @throws Exception
     */
    public static function throwException($exception): mixed
    {
        throw new Exception($exception);
    }
}
