<?php

namespace App\Http\Controllers\Api;

/**
 * Common API Schemas for OpenAPI Documentation
 *
 * @OA\Schema(
 *     schema="TimestampFields",
 *     type="object",
 *     title="Timestamp Fields",
 *     description="Common timestamp fields for all models",
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2023-12-01T10:00:00Z", description="Creation timestamp"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2023-12-01T15:30:00Z", description="Last update timestamp")
 * )
 *
 * @OA\Schema(
 *     schema="CommonFilters",
 *     type="object",
 *     title="Common Filter Parameters",
 *     description="Common filter parameters for list endpoints",
 *     @OA\Property(property="search", type="string", example="keyword", description="Search keyword"),
 *     @OA\Property(property="per_page", type="integer", example=15, minimum=1, maximum=100, description="Number of items per page"),
 *     @OA\Property(property="page", type="integer", example=1, minimum=1, description="Page number"),
 *     @OA\Property(property="sort_by", type="string", example="created_at", description="Field to sort by"),
 *     @OA\Property(property="sort_order", type="string", enum={"asc", "desc"}, example="desc", description="Sort order")
 * )
 *
 * @OA\Schema(
 *     schema="StatusFilter",
 *     type="object",
 *     title="Status Filter",
 *     description="Status-based filtering",
 *     @OA\Property(property="is_active", type="boolean", example=true, description="Filter by active status")
 * )
 *
 * @OA\Schema(
 *     schema="MediaUpload",
 *     type="object",
 *     title="Media Upload Schema",
 *     description="File upload schema for media",
 *     @OA\Property(property="file", type="string", format="binary", description="File to upload"),
 *     @OA\Property(property="alt_text", type="string", example="Image description", description="Alternative text for accessibility")
 * )
 *
 * @OA\Schema(
 *     schema="MediaResponse",
 *     type="object",
 *     title="Media Response",
 *     description="Response schema for uploaded media",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="filename", type="string", example="image.jpg"),
 *     @OA\Property(property="original_name", type="string", example="original-image.jpg"),
 *     @OA\Property(property="mime_type", type="string", example="image/jpeg"),
 *     @OA\Property(property="size", type="integer", example=1024000, description="File size in bytes"),
 *     @OA\Property(property="url", type="string", example="http://localhost:8000/storage/images/image.jpg"),
 *     @OA\Property(property="alt_text", type="string", example="Image description")
 * )
 *
 * @OA\Response(
 *     response="Success",
 *     description="Successful operation",
 *     @OA\JsonContent(ref="#/components/schemas/ApiResponse")
 * )
 *
 * @OA\Response(
 *     response="ValidationError",
 *     description="Validation error",
 *     @OA\JsonContent(ref="#/components/schemas/ValidationError")
 * )
 *
 * @OA\Response(
 *     response="NotFound",
 *     description="Resource not found",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false),
 *         @OA\Property(property="message", type="string", example="Resource not found")
 *     )
 * )
 *
 * @OA\Response(
 *     response="Unauthorized",
 *     description="Unauthorized access",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false),
 *         @OA\Property(property="message", type="string", example="Unauthorized")
 *     )
 * )
 *
 * @OA\Response(
 *     response="Forbidden",
 *     description="Forbidden access",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false),
 *         @OA\Property(property="message", type="string", example="Forbidden")
 *     )
 * )
 *
 * @OA\Response(
 *     response="ServerError",
 *     description="Internal server error",
 *     @OA\JsonContent(
 *         @OA\Property(property="success", type="boolean", example=false),
 *         @OA\Property(property="message", type="string", example="Internal server error")
 *     )
 * )
 */
class ApiSchemas
{
    // This class is used only for OpenAPI documentation schemas
    // No actual implementation needed
}
