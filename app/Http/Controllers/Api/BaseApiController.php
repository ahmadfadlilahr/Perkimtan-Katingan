<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Base API Controller for common API responses and methods
 *
 * @OA\Schema(
 *     schema="ApiResponse",
 *     type="object",
 *     title="Standard API Response",
 *     description="Standard response format for all API endpoints",
 *     @OA\Property(property="success", type="boolean", example=true, description="Success status"),
 *     @OA\Property(property="message", type="string", example="Operation completed successfully", description="Response message"),
 *     @OA\Property(property="data", type="object", description="Response data"),
 *     @OA\Property(property="meta", type="object", description="Additional metadata"),
 *     @OA\Property(property="errors", type="object", description="Validation errors (when applicable)")
 * )
 *
 * @OA\Schema(
 *     schema="PaginationMeta",
 *     type="object",
 *     title="Pagination Metadata",
 *     description="Pagination information for list endpoints",
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(property="last_page", type="integer", example=10),
 *     @OA\Property(property="per_page", type="integer", example=15),
 *     @OA\Property(property="total", type="integer", example=150),
 *     @OA\Property(property="from", type="integer", example=1),
 *     @OA\Property(property="to", type="integer", example=15)
 * )
 *
 * @OA\Schema(
 *     schema="ValidationError",
 *     type="object",
 *     title="Validation Error Response",
 *     description="Response format for validation errors",
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Validation failed"),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         example={"field_name": {"The field is required."}}
 *     )
 * )
 */
class BaseApiController extends Controller
{
    /**
     * Success response method
     */
    protected function sendResponse($result, $message = 'Success', $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];

        return response()->json($response, $code);
    }

    /**
     * Error response method
     */
    protected function sendError($error, $errorMessages = [], $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * Validation error response method
     */
    protected function sendValidationError($errors, $message = 'Validation failed'): JsonResponse
    {
        return $this->sendError($message, $errors, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Not found response method
     */
    protected function sendNotFound($message = 'Resource not found'): JsonResponse
    {
        return $this->sendError($message, [], Response::HTTP_NOT_FOUND);
    }

    /**
     * Unauthorized response method
     */
    protected function sendUnauthorized($message = 'Unauthorized'): JsonResponse
    {
        return $this->sendError($message, [], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Forbidden response method
     */
    protected function sendForbidden($message = 'Forbidden'): JsonResponse
    {
        return $this->sendError($message, [], Response::HTTP_FORBIDDEN);
    }
}
