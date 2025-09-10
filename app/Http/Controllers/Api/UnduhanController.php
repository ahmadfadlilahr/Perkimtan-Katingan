<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnduhanRequest;
use App\Http\Requests\UpdateUnduhanRequest;
use App\Http\Resources\UnduhanResource;
use App\Models\Unduhan;
use App\Services\UnduhanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * @OA\Tag(
 *     name="Unduhan",
 *     description="API endpoints for file downloads management"
 * )
 *
 * @OA\Schema(
 *     schema="UnduhanResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="judul", type="string", example="Panduan Penggunaan Aplikasi"),
 *     @OA\Property(property="deskripsi", type="string", example="Panduan lengkap penggunaan aplikasi untuk masyarakat"),
 *     @OA\Property(property="file", type="object",
 *         @OA\Property(property="filename", type="string", example="panduan.pdf"),
 *         @OA\Property(property="original_name", type="string", example="Panduan Penggunaan Aplikasi.pdf"),
 *         @OA\Property(property="extension", type="string", example="pdf"),
 *         @OA\Property(property="url", type="string", example="http://localhost:8000/storage/unduhan/panduan.pdf"),
 *         @OA\Property(property="download_url", type="string", example="http://localhost:8000/api/unduhan/1/download"),
 *         @OA\Property(property="size", type="integer", example=1048576),
 *         @OA\Property(property="size_human", type="string", example="1.00 MB")
 *     ),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01 10:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01 12:00:00"),
 *     @OA\Property(property="created_at_human", type="string", example="2 hours ago"),
 *     @OA\Property(property="updated_at_human", type="string", example="1 hour ago")
 * )
 */
class UnduhanController extends Controller
{
    protected UnduhanService $unduhanService;

    public function __construct(UnduhanService $unduhanService)
    {
        $this->unduhanService = $unduhanService;
        $this->middleware('auth:sanctum')->except(['publicIndex', 'publicShow', 'download']);
    }

    /**
     * @OA\Get(
     *     path="/api/public/unduhan",
     *     summary="Get files for public download",
     *     tags={"Unduhan"},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term for judul or deskripsi",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=10, minimum=1, maximum=100)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/UnduhanResource")),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function publicIndex(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'search' => 'nullable|string',
            'per_page' => 'integer|min:1|max:100',
        ]);

        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);

        $unduhan = $this->unduhanService->getPublicUnduhan($search, $perPage);

        return UnduhanResource::collection($unduhan);
    }

    /**
     * @OA\Get(
     *     path="/api/public/unduhan/{id}",
     *     summary="Get a single file for public download",
     *     tags={"Unduhan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Unduhan ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/UnduhanResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="File not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="File tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function publicShow(int $id): JsonResponse|UnduhanResource
    {
        $unduhan = Unduhan::find($id);

        if (!$unduhan) {
            return response()->json([
                'message' => 'File tidak ditemukan'
            ], 404);
        }

        return new UnduhanResource($unduhan);
    }

    /**
     * @OA\Get(
     *     path="/api/public/unduhan/{id}/download",
     *     summary="Download a file",
     *     tags={"Unduhan"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Unduhan ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="File download",
     *         @OA\MediaType(
     *             mediaType="application/octet-stream",
     *             @OA\Schema(type="string", format="binary")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="File not found or file does not exist",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="File tidak ditemukan atau tidak tersedia")
     *         )
     *     )
     * )
     */
    public function download(int $id): JsonResponse|BinaryFileResponse
    {
        $unduhan = Unduhan::find($id);

        if (!$unduhan) {
            return response()->json([
                'message' => 'File tidak ditemukan'
            ], 404);
        }

        $downloadResponse = $this->unduhanService->downloadFile($unduhan);

        if (!$downloadResponse) {
            return response()->json([
                'message' => 'File tidak tersedia'
            ], 404);
        }

        return $downloadResponse;
    }

    /**
     * @OA\Get(
     *     path="/api/unduhan",
     *     summary="Get all files with search and pagination (Admin)",
     *     tags={"Unduhan"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term for judul or deskripsi",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=10, minimum=1, maximum=100)
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Sort field",
     *         required=false,
     *         @OA\Schema(type="string", enum={"id", "judul", "deskripsi", "file", "created_at", "updated_at"}, default="id")
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Sort order",
     *         required=false,
     *         @OA\Schema(type="string", enum={"asc", "desc"}, default="desc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/UnduhanResource")),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'search' => 'nullable|string',
            'per_page' => 'integer|min:1|max:100',
            'sort' => 'nullable|string|in:id,judul,deskripsi,file,created_at,updated_at',
            'order' => 'nullable|string|in:asc,desc',
        ]);

        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'desc');

        $unduhan = $this->unduhanService->getAllUnduhan($search, $perPage, $sort, $order);

        return UnduhanResource::collection($unduhan);
    }

    /**
     * @OA\Post(
     *     path="/api/unduhan",
     *     summary="Create a new file (Admin)",
     *     tags={"Unduhan"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"judul", "file"},
     *                 @OA\Property(property="judul", type="string", maxLength=255, description="File title"),
     *                 @OA\Property(property="deskripsi", type="string", description="File description"),
     *                 @OA\Property(property="file", type="string", format="binary", description="File to upload (max 10MB, pdf/doc/docx/xls/xlsx/ppt/pptx/zip/rar/txt)")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="File created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="File berhasil dibuat"),
     *             @OA\Property(property="data", ref="#/components/schemas/UnduhanResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(StoreUnduhanRequest $request): JsonResponse
    {
        try {
            $unduhan = $this->unduhanService->createUnduhan($request->validated());

            return response()->json([
                'message' => 'File berhasil dibuat',
                'data' => new UnduhanResource($unduhan)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal membuat file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/unduhan/{unduhan}",
     *     summary="Get a single file (Admin)",
     *     tags={"Unduhan"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="unduhan",
     *         in="path",
     *         description="Unduhan ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/UnduhanResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="File not found"
     *     )
     * )
     */
    public function show(Unduhan $unduhan): UnduhanResource
    {
        return new UnduhanResource($unduhan);
    }

    /**
     * @OA\Post(
     *     path="/api/unduhan/{unduhan}",
     *     summary="Update a file (Admin)",
     *     tags={"Unduhan"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="unduhan",
     *         in="path",
     *         description="Unduhan ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"judul"},
     *                 @OA\Property(property="_method", type="string", enum={"PUT", "PATCH"}),
     *                 @OA\Property(property="judul", type="string", maxLength=255, description="File title"),
     *                 @OA\Property(property="deskripsi", type="string", description="File description"),
     *                 @OA\Property(property="file", type="string", format="binary", description="File to upload (max 10MB, pdf/doc/docx/xls/xlsx/ppt/pptx/zip/rar/txt)")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="File updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="File berhasil diperbarui"),
     *             @OA\Property(property="data", ref="#/components/schemas/UnduhanResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="File not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(UpdateUnduhanRequest $request, Unduhan $unduhan): JsonResponse
    {
        try {
            $updatedUnduhan = $this->unduhanService->updateUnduhan($unduhan, $request->validated());

            return response()->json([
                'message' => 'File berhasil diperbarui',
                'data' => new UnduhanResource($updatedUnduhan)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/unduhan/{unduhan}",
     *     summary="Delete a file (Admin)",
     *     tags={"Unduhan"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="unduhan",
     *         in="path",
     *         description="Unduhan ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="File deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="File berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="File not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to delete file"
     *     )
     * )
     */
    public function destroy(Unduhan $unduhan): JsonResponse
    {
        try {
            $success = $this->unduhanService->deleteUnduhan($unduhan);

            if (!$success) {
                return response()->json([
                    'message' => 'Gagal menghapus file'
                ], 500);
            }

            return response()->json([
                'message' => 'File berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus file',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/unduhan/stats",
     *     summary="Get file statistics (Admin)",
     *     tags={"Unduhan"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="total_unduhan", type="integer", description="Total number of files"),
     *                 @OA\Property(property="total_file_size", type="integer", description="Total file size in bytes"),
     *                 @OA\Property(property="total_file_size_human", type="string", description="Human readable total file size")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function stats(): JsonResponse
    {
        $stats = $this->unduhanService->getUnduhanStats();

        return response()->json([
            'data' => $stats
        ]);
    }
}
