<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGaleriRequest;
use App\Http\Requests\UpdateGaleriRequest;
use App\Http\Resources\GaleriCollection;
use App\Http\Resources\GaleriResource;
use App\Models\Galeri;
use App\Services\GaleriService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Galeri",
 *     description="API endpoints for gallery management"
 * )
 */
class GaleriController extends Controller
{
    protected $galeriService;

    public function __construct(GaleriService $galeriService)
    {
        $this->galeriService = $galeriService;
        $this->middleware('auth:sanctum')->except(['publicIndex', 'publicShow']);
    }

    /**
     * @OA\Get(
     *     path="/api/public/galeri",
     *     tags={"Galeri"},
     *     summary="Get list of public galleries",
     *     description="Returns paginated list of galleries without authentication",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search galleries by description",
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
     *         description="Sort by field (id, keterangan, created_at)",
     *         required=false,
     *         @OA\Schema(type="string", default="created_at")
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Sort order (asc, desc)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"asc", "desc"}, default="desc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of galleries",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/GaleriResource")),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data galeri berhasil diambil"),
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
            $sort = $request->get('sort', 'created_at');
            $order = $request->get('order', 'desc');

            $galeri = $this->galeriService->getAllGaleri($search, $perPage, $sort, $order);

            return response()->json(new GaleriCollection($galeri));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/public/galeri/{id}",
     *     tags={"Galeri"},
     *     summary="Get single gallery by ID (public)",
     *     description="Returns a single gallery without authentication",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Gallery ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Gallery details",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/GaleriResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data galeri berhasil diambil")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Gallery not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Galeri tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function publicShow($id): JsonResponse
    {
        try {
            $galeri = Galeri::findOrFail($id);

            return response()->json([
                'data' => new GaleriResource($galeri),
                'success' => true,
                'message' => 'Data galeri berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/galeri",
     *     tags={"Galeri"},
     *     summary="Get list of galleries (admin)",
     *     description="Returns paginated list of all galleries with authentication required",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search galleries by description",
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
     *         description="Sort by field (id, keterangan, created_at)",
     *         required=false,
     *         @OA\Schema(type="string", default="created_at")
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Sort order (asc, desc)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"asc", "desc"}, default="desc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of galleries",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/GaleriResource")),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data galeri berhasil diambil"),
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
            $sort = $request->get('sort', 'created_at');
            $order = $request->get('order', 'desc');

            $galeri = $this->galeriService->getAllGaleri($search, $perPage, $sort, $order);

            return response()->json(new GaleriCollection($galeri));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/galeri",
     *     tags={"Galeri"},
     *     summary="Create new gallery",
     *     description="Create a new gallery item with image upload",
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"gambar"},
     *                 @OA\Property(property="keterangan", type="string", example="Foto kegiatan gotong royong di kampung"),
     *                 @OA\Property(
     *                     property="gambar",
     *                     type="string",
     *                     format="binary",
     *                     description="Image file (jpg, jpeg, png, webp - max 2MB)"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Gallery created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/GaleriResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Galeri berhasil dibuat")
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
     *                 @OA\Property(property="gambar", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="keterangan", type="array", @OA\Items(type="string"))
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
    public function store(StoreGaleriRequest $request): JsonResponse
    {
        try {
            $galeri = $this->galeriService->createGaleri($request->validated());

            return response()->json([
                'data' => new GaleriResource($galeri),
                'success' => true,
                'message' => 'Galeri berhasil dibuat'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat galeri: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/galeri/{galeri}",
     *     tags={"Galeri"},
     *     summary="Get single gallery by ID (admin)",
     *     description="Returns a single gallery with authentication required",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="galeri",
     *         in="path",
     *         description="Gallery ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Gallery details",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/GaleriResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data galeri berhasil diambil")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Gallery not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Galeri tidak ditemukan")
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
            $galeri = Galeri::findOrFail($id);

            return response()->json([
                'data' => new GaleriResource($galeri),
                'success' => true,
                'message' => 'Data galeri berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/galeri/{galeri}",
     *     tags={"Galeri"},
     *     summary="Update gallery",
     *     description="Update an existing gallery item (use POST with _method=PUT for file uploads)",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="galeri",
     *         in="path",
     *         description="Gallery ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="_method", type="string", example="PUT"),
     *                 @OA\Property(property="keterangan", type="string", example="Foto kegiatan gotong royong yang diperbarui"),
     *                 @OA\Property(
     *                     property="gambar",
     *                     type="string",
     *                     format="binary",
     *                     description="New image file (optional - jpg, jpeg, png, webp - max 2MB)"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Gallery updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/GaleriResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Galeri berhasil diperbarui")
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
     *                 @OA\Property(property="gambar", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="keterangan", type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Gallery not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Galeri tidak ditemukan")
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
    public function update(UpdateGaleriRequest $request, $id): JsonResponse
    {
        try {
            $galeri = Galeri::findOrFail($id);
            $updatedGaleri = $this->galeriService->updateGaleri($galeri, $request->validated());

            return response()->json([
                'data' => new GaleriResource($updatedGaleri),
                'success' => true,
                'message' => 'Galeri berhasil diperbarui'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui galeri: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/galeri/{galeri}",
     *     tags={"Galeri"},
     *     summary="Delete gallery",
     *     description="Delete a gallery item and its associated image file",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="galeri",
     *         in="path",
     *         description="Gallery ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Gallery deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Galeri berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Gallery not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Galeri tidak ditemukan")
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
            $galeri = Galeri::findOrFail($id);
            $this->galeriService->deleteGaleri($galeri);

            return response()->json([
                'success' => true,
                'message' => 'Galeri berhasil dihapus'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Galeri tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus galeri: ' . $e->getMessage()
            ], 500);
        }
    }
}
