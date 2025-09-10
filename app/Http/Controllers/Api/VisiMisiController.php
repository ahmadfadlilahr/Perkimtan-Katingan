<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use App\Services\VisiMisiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

/**
 * @OA\Tag(
 *     name="Visi Misi",
 *     description="API endpoints for managing Visi Misi"
 * )
 *
 * @OA\Schema(
 *     schema="VisiMisi",
 *     type="object",
 *     title="VisiMisi",
 *     description="Visi Misi model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="type", type="string", enum={"visi", "misi"}, example="visi"),
 *     @OA\Property(property="title", type="string", example="Visi Organisasi"),
 *     @OA\Property(property="content", type="string", example="Menjadi organisasi terdepan dalam pelayanan publik"),
 *     @OA\Property(property="description", type="string", example="Deskripsi tambahan untuk item ini"),
 *     @OA\Property(property="icon", type="string", example="eye"),
 *     @OA\Property(property="color_class", type="string", example="blue"),
 *     @OA\Property(property="order_position", type="integer", example=1),
 *     @OA\Property(property="is_active", type="boolean", example=true),
 *     @OA\Property(property="type_name", type="string", example="Visi"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="VisiMisiResponse",
 *     type="object",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="Operation completed successfully"),
 *     @OA\Property(property="data", ref="#/components/schemas/VisiMisi")
 * )
 *
 * @OA\Schema(
 *     schema="ErrorResponse",
 *     type="object",
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="An error occurred"),
 *     @OA\Property(property="error", type="string", example="Detailed error message")
 * )
 */
class VisiMisiController extends Controller
{
    protected VisiMisiService $visiMisiService;

    public function __construct(VisiMisiService $visiMisiService)
    {
        $this->middleware('auth:sanctum')->except(['index']);
        $this->visiMisiService = $visiMisiService;
    }

    /**
     * @OA\Get(
     *     path="/api/public/visi-misi",
     *     summary="Get all visi misi items",
     *     tags={"Visi Misi"},
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filter by type (visi, misi)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"visi", "misi"})
     *     ),
     *     @OA\Parameter(
     *         name="active_only",
     *         in="query",
     *         description="Show only active items",
     *         required=false,
     *         @OA\Schema(type="boolean", default=true)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="visi",
     *                     type="object",
     *                     @OA\Property(property="name", type="string", example="Visi"),
     *                     @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/VisiMisi"))
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $type = $request->query('type');
            $activeOnly = $request->boolean('active_only', true);

            if ($type) {
                $data = $this->visiMisiService->getByType($type, $activeOnly);
            } else {
                $data = $this->visiMisiService->getAllGroupedByType($activeOnly);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/visi-misi",
     *     summary="Create a new visi misi item",
     *     tags={"Visi Misi"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"type", "title", "content"},
     *             @OA\Property(property="type", type="string", enum={"visi", "misi"}),
     *             @OA\Property(property="title", type="string", example="Visi Organisasi"),
     *             @OA\Property(property="content", type="string", example="Menjadi organisasi terdepan..."),
     *             @OA\Property(property="description", type="string", example="Deskripsi tambahan"),
     *             @OA\Property(property="icon", type="string", example="eye"),
     *             @OA\Property(property="color_class", type="string", example="blue"),
     *             @OA\Property(property="order_position", type="integer", example=1),
     *             @OA\Property(property="is_active", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Item created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/VisiMisiResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(ref="#/components/schemas/ValidationError")
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'type' => ['required', 'string', Rule::in(array_keys(VisiMisi::getTypes()))],
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'description' => 'nullable|string',
                'icon' => 'nullable|string|max:100',
                'color_class' => 'nullable|string|max:100',
                'order_position' => 'nullable|integer|min:0',
                'is_active' => 'boolean'
            ]);

            $visiMisi = $this->visiMisiService->create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Visi Misi item created successfully',
                'data' => $visiMisi
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/visi-misi/{visiMisi}",
     *     summary="Get a specific visi misi item",
     *     tags={"Visi Misi"},
     *     @OA\Parameter(
     *         name="visiMisi",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/VisiMisiResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *     )
     * )
     */
    public function show(VisiMisi $visiMisi): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $visiMisi
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/visi-misi/{visiMisi}",
     *     summary="Update a visi misi item",
     *     tags={"Visi Misi"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="visiMisi",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="type", type="string", enum={"visi", "misi"}),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="content", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="icon", type="string"),
     *             @OA\Property(property="color_class", type="string"),
     *             @OA\Property(property="order_position", type="integer"),
     *             @OA\Property(property="is_active", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/VisiMisiResponse")
     *     )
     * )
     */
    public function update(Request $request, VisiMisi $visiMisi): JsonResponse
    {
        try {
            $validated = $request->validate([
                'type' => ['sometimes', 'string', Rule::in(array_keys(VisiMisi::getTypes()))],
                'title' => 'sometimes|string|max:255',
                'content' => 'sometimes|string',
                'description' => 'nullable|string',
                'icon' => 'nullable|string|max:100',
                'color_class' => 'nullable|string|max:100',
                'order_position' => 'nullable|integer|min:0',
                'is_active' => 'boolean'
            ]);

            $updatedVisiMisi = $this->visiMisiService->update($visiMisi, $validated);

            return response()->json([
                'success' => true,
                'message' => 'Visi Misi item updated successfully',
                'data' => $updatedVisiMisi
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/visi-misi/{visiMisi}",
     *     summary="Delete a visi misi item",
     *     tags={"Visi Misi"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="visiMisi",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Item deleted successfully")
     *         )
     *     )
     * )
     */
    public function destroy(VisiMisi $visiMisi): JsonResponse
    {
        try {
            $this->visiMisiService->delete($visiMisi);

            return response()->json([
                'success' => true,
                'message' => 'Visi Misi item deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/visi-misi/{visiMisi}/toggle-active",
     *     summary="Toggle active status of a visi misi item",
     *     tags={"Visi Misi"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="visiMisi",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Status toggled successfully",
     *         @OA\JsonContent(ref="#/components/schemas/VisiMisiResponse")
     *     )
     * )
     */
    public function toggleActive(VisiMisi $visiMisi): JsonResponse
    {
        try {
            $updatedVisiMisi = $this->visiMisiService->toggleActive($visiMisi);

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'data' => $updatedVisiMisi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/visi-misi/reorder",
     *     summary="Reorder visi misi items within a type",
     *     tags={"Visi Misi"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"type", "item_ids"},
     *             @OA\Property(property="type", type="string", enum={"visi", "misi"}),
     *             @OA\Property(property="item_ids", type="array", @OA\Items(type="integer"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Items reordered successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Items reordered successfully")
     *         )
     *     )
     * )
     */
    public function reorder(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'type' => ['required', 'string', Rule::in(array_keys(VisiMisi::getTypes()))],
                'item_ids' => 'required|array',
                'item_ids.*' => 'integer|exists:visi_misis,id'
            ]);

            $this->visiMisiService->reorder($validated['type'], $validated['item_ids']);

            return response()->json([
                'success' => true,
                'message' => 'Items reordered successfully'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to reorder items',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
