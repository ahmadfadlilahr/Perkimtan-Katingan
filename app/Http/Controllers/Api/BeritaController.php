<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use App\Http\Resources\BeritaResource;
use App\Http\Resources\BeritaCollection;
use App\Models\Berita;
use App\Services\BeritaService;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Berita",
 *     type="object",
 *     title="Berita Model",
 *     description="Model data berita",
 *     @OA\Property(property="id", type="integer", example=1, description="ID berita"),
 *     @OA\Property(property="judul", type="string", example="Judul Berita", description="Judul berita"),
 *     @OA\Property(property="slug", type="string", example="judul-berita", description="Slug berita"),
 *     @OA\Property(property="konten", type="string", example="Konten berita lengkap", description="Konten berita"),
 *     @OA\Property(property="excerpt", type="string", example="Ringkasan berita", description="Excerpt berita"),
 *     @OA\Property(property="gambar", type="string", example="berita/image.jpg", description="Path gambar berita"),
 *     @OA\Property(property="status", type="string", enum={"draft", "published"}, example="published", description="Status berita"),
 *     @OA\Property(property="tanggal_publish", type="string", format="date-time", example="2024-01-01T10:00:00Z", description="Tanggal publish"),
 *     @OA\Property(property="views", type="integer", example=100, description="Jumlah views"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T10:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T10:00:00Z")
 * )
 */
class BeritaController extends Controller
{
    protected $beritaService;

    public function __construct(BeritaService $beritaService)
    {
        $this->beritaService = $beritaService;
        $this->middleware('auth:sanctum')->except(['publicIndex', 'publicShow']);
    }
    /**
     * @OA\Get(
     *     path="/api/public/berita",
     *     summary="[PUBLIC] Menampilkan berita yang sudah dipublish",
     *     description="Endpoint public untuk menampilkan daftar berita yang sudah dipublish tanpa perlu authentication",
     *     tags={"Public Endpoints"},
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Jumlah data per halaman (default: 10)",
     *         required=false,
     *         @OA\Schema(type="integer", example=5)
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Pencarian berdasarkan judul berita",
     *         required=false,
     *         @OA\Schema(type="string", example="pengumuman")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data berita public",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data berita berhasil diambil"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Berita"))
     *         )
     *     )
     * )
     */
    /**
     * @OA\Get(
     *     path="/api/berita",
     *     summary="[PROTECTED] Menampilkan semua data berita",
     *     description="Endpoint untuk admin melihat semua berita termasuk draft",
     *     tags={"Berita"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter berdasarkan status (published/draft)",
     *         required=false,
     *         @OA\Schema(type="string", enum={"published", "draft"})
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Jumlah data per halaman (default: 10)",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operasi berhasil. Mengembalikan daftar berita.",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Berita"))
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $filters = [];
        if ($request->has('status')) {
            $filters['status'] = $request->status;
        } else {
            // Default untuk API publik
            $filters['status'] = 'published';
        }

        if ($request->has('search')) {
            $filters['search'] = $request->search;
        }

        $limit = $request->get('limit', 10);
        $berita = $this->beritaService->getAllBerita($filters, $limit);

        return new BeritaCollection($berita);
    }    /**
     * @OA\Post(
     *     path="/api/berita",
     *     summary="Membuat berita baru",
     *     tags={"Berita"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="judul", type="string", maxLength=255, description="Judul berita"),
     *                 @OA\Property(property="penulis", type="string", maxLength=255, description="Nama penulis (optional, akan menggunakan user login)"),
     *                 @OA\Property(property="isi", type="string", description="Konten berita"),
     *                 @OA\Property(property="gambar", type="string", format="binary", description="File gambar berita"),
     *                 @OA\Property(property="status", type="string", enum={"published", "draft"}, description="Status publikasi"),
     *                 required={"judul", "isi", "status"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Berita berhasil dibuat",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", ref="#/components/schemas/Berita")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function store(StoreBeritaRequest $request)
    {
        try {
            $validatedData = $request->validated();

            // Get authenticated user (from middleware)
            $user = $request->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated.'
                ], 401);
            }

            // Remove penulis from validated data since it will be automatically set by the service
            unset($validatedData['penulis']);

            $berita = $this->beritaService->createBerita(
                $validatedData,
                $request->file('gambar')
            );

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dibuat',
                'data' => new BeritaResource($berita)
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/public/berita/{slug}",
     *     summary="[PUBLIC] Menampilkan detail berita yang sudah dipublish",
     *     description="Endpoint public untuk melihat detail berita berdasarkan slug tanpa perlu authentication",
     *     tags={"Public Endpoints"},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         description="Slug dari berita",
     *         example="pengumuman-penting-2025",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil detail berita",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Detail Data Berita"),
     *             @OA\Property(property="data", ref="#/components/schemas/Berita")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Berita tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Data tidak ditemukan")
     *         )
     *     )
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/berita/{berita}",
     *     summary="[PROTECTED] Menampilkan detail satu berita",
     *     description="Endpoint untuk admin melihat detail berita terincluding yang masih draft",
     *     tags={"Berita"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="berita",
     *         in="path",
     *         required=true,
     *         description="ID dari berita",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operasi berhasil",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", ref="#/components/schemas/Berita")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
 */
public function show(Berita $berita)
{
    try {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Berita',
            'data' => new BeritaResource($berita)
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
    }
}

    /**
     * @OA\Put(
     *     path="/api/berita/{berita}",
     *     summary="Mengupdate data berita",
     *     tags={"Berita"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="berita",
     *         in="path",
     *         required=true,
     *         description="ID berita",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="judul", type="string", maxLength=255, description="Judul berita"),
     *                 @OA\Property(property="penulis", type="string", maxLength=255, description="Nama penulis"),
     *                 @OA\Property(property="isi", type="string", description="Konten berita"),
     *                 @OA\Property(property="gambar", type="string", format="binary", description="File gambar berita (opsional)"),
     *                 @OA\Property(property="status", type="string", enum={"published", "draft"}, description="Status publikasi"),
     *                 @OA\Property(property="_method", type="string", enum={"PUT"}, description="Method spoofing untuk Laravel"),
     *                 required={"judul", "penulis", "isi", "status"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berita berhasil diupdate",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="data", ref="#/components/schemas/Berita")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        try {
            $updatedBerita = $this->beritaService->updateBerita(
                $berita,
                $request->validated(),
                $request->file('gambar')
            );

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil diupdate',
                'data' => new BeritaResource($updatedBerita)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }    /**
     * @OA\Delete(
     *     path="/api/berita/{berita}",
     *     summary="Menghapus data berita",
     *     tags={"Berita"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="berita",
     *         in="path",
     *         required=true,
     *         description="ID berita",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berita berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Data tidak ditemukan"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function destroy(Berita $berita)
    {
        try {
            $this->beritaService->deleteBerita($berita);

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dihapus!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // ===========================
    // PUBLIC ENDPOINTS (No Auth)
    // ===========================

    /**
     * @OA\Get(
     *     path="/api/public/berita",
     *     summary="[PUBLIC] Daftar berita yang sudah dipublish",
     *     description="Endpoint public untuk mengambil daftar berita yang sudah dipublish tanpa perlu authentication",
     *     tags={"Berita"},
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Jumlah data per halaman (default: 10)",
     *         required=false,
     *         @OA\Schema(type="integer", example=5)
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Pencarian berdasarkan judul berita",
     *         required=false,
     *         @OA\Schema(type="string", example="pengumuman")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data berita public",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data berita berhasil diambil"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Berita"))
     *         )
     *     )
     * )
     */
    public function publicIndex(Request $request)
    {
        $filters = ['status' => 'published'];

        if ($request->has('search')) {
            $filters['search'] = $request->search;
        }

        $limit = $request->get('limit', 10);
        $berita = $this->beritaService->getAllBerita($filters, $limit);

        return new BeritaCollection($berita);
    }

    /**
     * @OA\Get(
     *     path="/api/public/berita/{slug}",
     *     summary="[PUBLIC] Detail berita yang sudah dipublish",
     *     description="Endpoint public untuk melihat detail berita berdasarkan slug tanpa perlu authentication",
     *     tags={"Berita"},
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         description="Slug dari berita",
     *         example="pengumuman-penting-2025",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil detail berita",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Detail Data Berita"),
     *             @OA\Property(property="data", ref="#/components/schemas/Berita")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Berita tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Data tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function publicShow($slug)
    {
        try {
            $berita = $this->beritaService->getBeritaBySlug($slug, true); // Only published

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Berita',
                'data' => new BeritaResource($berita)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }
}
