<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePejabatRequest;
use App\Http\Requests\UpdatePejabatRequest;
use App\Http\Resources\PejabatCollection;
use App\Http\Resources\PejabatResource;
use App\Models\Pejabat;
use App\Services\PejabatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Pejabat",
 *     description="API endpoints for official management"
 * )
 */
class PejabatController extends Controller
{
    protected $pejabatService;

    public function __construct(PejabatService $pejabatService)
    {
        $this->pejabatService = $pejabatService;
        $this->middleware('auth:sanctum')->except(['publicIndex', 'publicShow']);
    }

    /**
     * @OA\Get(
     *     path="/api/public/pejabat",
     *     tags={"Pejabat"},
     *     summary="Get list of officials (public)",
     *     description="Returns paginated list of officials ordered by position without authentication",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search officials by name, position, or NIP",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page (max 100)",
     *         required=false,
     *         @OA\Schema(type="integer", minimum=1, maximum=100, default=10)
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Sort by field (urutan, nama, jabatan, created_at)",
     *         required=false,
     *         @OA\Schema(type="string", default="urutan")
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Sort order (asc, desc)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"asc", "desc"}, default="asc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of officials",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/PejabatResource")),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data pejabat berhasil diambil"),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="total", type="integer"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="last_page", type="integer")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Terjadi kesalahan sistem")
     *         )
     *     )
     * )
     */
    public function publicIndex(Request $request): JsonResponse
    {
        try {
            $search = $request->get('search');
            $perPage = min($request->get('per_page', 10), 100);
            $sort = $request->get('sort', 'urutan');
            $order = $request->get('order', 'asc');

            $pejabat = $this->pejabatService->getAllPejabat($search, $perPage, $sort, $order);

            return response()->json(new PejabatCollection($pejabat));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/public/pejabat/{id}",
     *     tags={"Pejabat"},
     *     summary="Get single official by ID (public)",
     *     description="Returns a single official without authentication",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Official ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Official details",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/PejabatResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data pejabat berhasil diambil")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Official not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Pejabat tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function publicShow($id): JsonResponse
    {
        try {
            $pejabat = Pejabat::findOrFail($id);

            return response()->json([
                'data' => new PejabatResource($pejabat),
                'success' => true,
                'message' => 'Data pejabat berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pejabat tidak ditemukan'
            ], 404);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/pejabat",
     *     tags={"Pejabat"},
     *     summary="Get list of officials (admin)",
     *     description="Returns paginated list of all officials with authentication required",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search officials by name, position, or NIP",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page (max 100)",
     *         required=false,
     *         @OA\Schema(type="integer", minimum=1, maximum=100, default=10)
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Sort by field (id, nama, jabatan, nip, urutan, created_at, updated_at)",
     *         required=false,
     *         @OA\Schema(type="string", default="urutan")
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Sort order (asc, desc)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"asc", "desc"}, default="asc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of officials",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/PejabatResource")),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data pejabat berhasil diambil"),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="total", type="integer"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="last_page", type="integer")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $search = $request->get('search');
            $perPage = min($request->get('per_page', 10), 100);
            $sort = $request->get('sort', 'urutan');
            $order = $request->get('order', 'asc');

            $pejabat = $this->pejabatService->getAllPejabat($search, $perPage, $sort, $order);

            return response()->json(new PejabatCollection($pejabat));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/pejabat",
     *     tags={"Pejabat"},
     *     summary="Create new official",
     *     description="Create a new official with optional photo upload",
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"nama", "jabatan"},
     *                 @OA\Property(property="nama", type="string", example="Dr. John Doe, M.T.", description="Official name"),
     *                 @OA\Property(property="jabatan", type="string", example="Kepala Dinas Perumahan dan Kawasan Permukiman", description="Official position"),
     *                 @OA\Property(property="nip", type="string", example="197001011990011001", description="Official NIP (optional)"),
     *                 @OA\Property(property="urutan", type="integer", example=1, description="Display order (optional, auto-increment if not provided)"),
     *                 @OA\Property(
     *                     property="foto",
     *                     type="string",
     *                     format="binary",
     *                     description="Official photo (optional - jpg, jpeg, png, webp - max 2MB)"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Official created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/PejabatResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Pejabat berhasil dibuat")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="nama", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="jabatan", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="nip", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="foto", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="urutan", type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function store(StorePejabatRequest $request): JsonResponse
    {
        try {
            $pejabat = $this->pejabatService->createPejabat($request->validated());

            return response()->json([
                'data' => new PejabatResource($pejabat),
                'success' => true,
                'message' => 'Pejabat berhasil dibuat'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat pejabat: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/pejabat/{pejabat}",
     *     tags={"Pejabat"},
     *     summary="Get single official by ID (admin)",
     *     description="Returns a single official with authentication required",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="pejabat",
     *         in="path",
     *         description="Official ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Official details",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/PejabatResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data pejabat berhasil diambil")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Official not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Pejabat tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $pejabat = Pejabat::findOrFail($id);

            return response()->json([
                'data' => new PejabatResource($pejabat),
                'success' => true,
                'message' => 'Data pejabat berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pejabat tidak ditemukan'
            ], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/pejabat/{pejabat}",
     *     tags={"Pejabat"},
     *     summary="Update official",
     *     description="Update an existing official (use POST with _method=PUT for file uploads)",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="pejabat",
     *         in="path",
     *         description="Official ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"nama", "jabatan"},
     *                 @OA\Property(property="_method", type="string", example="PUT"),
     *                 @OA\Property(property="nama", type="string", example="Dr. John Doe, M.T. (Updated)", description="Updated official name"),
     *                 @OA\Property(property="jabatan", type="string", example="Kepala Dinas (Updated)", description="Updated official position"),
     *                 @OA\Property(property="nip", type="string", example="197001011990011001", description="Official NIP (optional)"),
     *                 @OA\Property(property="urutan", type="integer", example=2, description="Display order (optional)"),
     *                 @OA\Property(
     *                     property="foto",
     *                     type="string",
     *                     format="binary",
     *                     description="New official photo (optional - jpg, jpeg, png, webp - max 2MB)"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Official updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/PejabatResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Pejabat berhasil diperbarui")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="nama", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="jabatan", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="nip", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="foto", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="urutan", type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Official not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Pejabat tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function update(UpdatePejabatRequest $request, $id): JsonResponse
    {
        try {
            $pejabat = Pejabat::findOrFail($id);
            $updatedPejabat = $this->pejabatService->updatePejabat($pejabat, $request->validated());

            return response()->json([
                'data' => new PejabatResource($updatedPejabat),
                'success' => true,
                'message' => 'Pejabat berhasil diperbarui'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pejabat tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui pejabat: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/pejabat/{pejabat}",
     *     tags={"Pejabat"},
     *     summary="Delete official",
     *     description="Delete an official and their associated photo file",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="pejabat",
     *         in="path",
     *         description="Official ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Official deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Pejabat berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Official not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Pejabat tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $pejabat = Pejabat::findOrFail($id);
            $this->pejabatService->deletePejabat($pejabat);

            return response()->json([
                'success' => true,
                'message' => 'Pejabat berhasil dihapus'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pejabat tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pejabat: ' . $e->getMessage()
            ], 500);
        }
    }
}
