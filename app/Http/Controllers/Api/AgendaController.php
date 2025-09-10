<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AgendaRequest;
use App\Http\Resources\AgendaResource;
use App\Models\Agenda;
use App\Services\AgendaService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Agenda",
 *     description="API Endpoints untuk mengelola agenda"
 * )
 */
class AgendaController extends Controller
{
    private AgendaService $agendaService;

    public function __construct(AgendaService $agendaService)
    {
        $this->agendaService = $agendaService;
        $this->middleware('auth:sanctum')->except(['publicIndex', 'publicShow']);
    }

    /**
     * Display a listing of agenda for public view
     *
     * @OA\Get(
     *     path="/api/public/agenda",
     *     tags={"Agenda"},
     *     summary="Mengambil daftar agenda publik",
     *     description="Menampilkan daftar agenda yang berstatus published dan publik dengan fitur filter",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Kata kunci pencarian",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         description="Filter berdasarkan kategori",
     *         required=false,
     *         @OA\Schema(type="string", enum={"rapat", "sosialisasi", "workshop", "acara_publik"})
     *     ),
     *     @OA\Parameter(
     *         name="month",
     *         in="query",
     *         description="Filter berdasarkan bulan (1-12)",
     *         required=false,
     *         @OA\Schema(type="integer", minimum=1, maximum=12)
     *     ),
     *     @OA\Parameter(
     *         name="year",
     *         in="query",
     *         description="Filter berdasarkan tahun",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Jumlah data per halaman",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data agenda",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data agenda berhasil diambil"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/AgendaResource")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="from", type="integer"),
     *                 @OA\Property(property="last_page", type="integer"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="to", type="integer"),
     *                 @OA\Property(property="total", type="integer")
     *             )
     *         )
     *     )
     * )
     */
    public function publicIndex(Request $request): JsonResponse
    {
        $filters = [
            'search' => $request->query('search'),
            'category' => $request->query('category'),
            'month' => $request->query('month'),
            'year' => $request->query('year')
        ];

        $perPage = $request->query('per_page', 15);
        $agendas = $this->agendaService->getPublicAgendas($filters, $perPage);

        return response()->json([
            'success' => true,
            'message' => 'Data agenda berhasil diambil',
            'data' => AgendaResource::collection($agendas->items()),
            'meta' => [
                'current_page' => $agendas->currentPage(),
                'from' => $agendas->firstItem(),
                'last_page' => $agendas->lastPage(),
                'per_page' => $agendas->perPage(),
                'to' => $agendas->lastItem(),
                'total' => $agendas->total(),
            ]
        ]);
    }

    /**
     * Display the specified agenda for public view
     *
     * @OA\Get(
     *     path="/api/public/agenda/{slug}",
     *     tags={"Agenda"},
     *     summary="Mengambil detail agenda publik berdasarkan slug",
     *     description="Menampilkan detail agenda berdasarkan slug untuk publik",
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Slug agenda",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil detail agenda",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data agenda berhasil diambil"),
     *             @OA\Property(property="data", ref="#/components/schemas/AgendaResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Agenda tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Agenda tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function publicShow(string $slug): JsonResponse
    {
        $agenda = $this->agendaService->getBySlug($slug);

        if (!$agenda || !$agenda->is_publik || $agenda->status !== 'published') {
            return response()->json([
                'success' => false,
                'message' => 'Agenda tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data agenda berhasil diambil',
            'data' => new AgendaResource($agenda)
        ]);
    }

    /**
     * Display a listing of the resource for admin
     *
     * @OA\Get(
     *     path="/api/agenda",
     *     tags={"Agenda"},
     *     summary="Mengambil daftar agenda untuk admin",
     *     description="Menampilkan daftar agenda untuk admin dengan fitur filter lengkap",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Kata kunci pencarian",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter berdasarkan status",
     *         required=false,
     *         @OA\Schema(type="string", enum={"draft", "published", "archived"})
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="query",
     *         description="Filter berdasarkan kategori",
     *         required=false,
     *         @OA\Schema(type="string", enum={"rapat", "sosialisasi", "workshop", "acara_publik"})
     *     ),
     *     @OA\Parameter(
     *         name="is_publik",
     *         in="query",
     *         description="Filter berdasarkan status publik",
     *         required=false,
     *         @OA\Schema(type="boolean")
     *     ),
     *     @OA\Parameter(
     *         name="date_from",
     *         in="query",
     *         description="Filter tanggal mulai (YYYY-MM-DD)",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="date_to",
     *         in="query",
     *         description="Filter tanggal akhir (YYYY-MM-DD)",
     *         required=false,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Jumlah data per halaman",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data agenda",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data agenda berhasil diambil"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/AgendaResource")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="from", type="integer"),
     *                 @OA\Property(property="last_page", type="integer"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(property="to", type="integer"),
     *                 @OA\Property(property="total", type="integer")
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
        $agendas = $this->agendaService->getAllAgendas(
            perPage: $request->query('per_page', 15),
            filters: $request->only(['search', 'status', 'category', 'is_publik', 'date_from', 'date_to'])
        );

        return response()->json([
            'success' => true,
            'message' => 'Data agenda berhasil diambil',
            'data' => AgendaResource::collection($agendas->items()),
            'meta' => [
                'current_page' => $agendas->currentPage(),
                'from' => $agendas->firstItem(),
                'last_page' => $agendas->lastPage(),
                'per_page' => $agendas->perPage(),
                'to' => $agendas->lastItem(),
                'total' => $agendas->total(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage
     *
     * @OA\Post(
     *     path="/api/agenda",
     *     tags={"Agenda"},
     *     summary="Membuat agenda baru",
     *     description="Menambahkan agenda baru ke sistem",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data agenda yang akan dibuat",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/AgendaRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Agenda berhasil dibuat",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Agenda berhasil dibuat"),
     *             @OA\Property(property="data", ref="#/components/schemas/AgendaResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Gagal membuat agenda: error message")
     *         )
     *     )
     * )
     */
    public function store(AgendaRequest $request): JsonResponse
    {
        try {
            $agenda = $this->agendaService->createAgenda($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Agenda berhasil dibuat',
                'data' => new AgendaResource($agenda)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat agenda: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource
     *
     * @OA\Get(
     *     path="/api/agenda/{agenda}",
     *     tags={"Agenda"},
     *     summary="Mengambil detail agenda berdasarkan ID",
     *     description="Menampilkan detail agenda berdasarkan ID untuk admin",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="agenda",
     *         in="path",
     *         description="ID agenda",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil detail agenda",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data agenda berhasil diambil"),
     *             @OA\Property(property="data", ref="#/components/schemas/AgendaResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Agenda tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Agenda tidak ditemukan")
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
    public function show(Agenda $agenda): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Data agenda berhasil diambil',
            'data' => new AgendaResource($agenda)
        ]);
    }

    /**
     * Update the specified resource in storage
     *
     * @OA\Put(
     *     path="/api/agenda/{agenda}",
     *     tags={"Agenda"},
     *     summary="Memperbarui agenda",
     *     description="Memperbarui data agenda yang sudah ada",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="agenda",
     *         in="path",
     *         description="ID agenda",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Data agenda yang akan diperbarui",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/AgendaRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Agenda berhasil diperbarui",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Agenda berhasil diperbarui"),
     *             @OA\Property(property="data", ref="#/components/schemas/AgendaResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Agenda tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Agenda tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Gagal memperbarui agenda: error message")
     *         )
     *     )
     * )
     */
    public function update(AgendaRequest $request, Agenda $agenda): JsonResponse
    {
        try {
            $updatedAgenda = $this->agendaService->updateAgenda($agenda, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Agenda berhasil diperbarui',
                'data' => new AgendaResource($updatedAgenda)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui agenda: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage
     *
     * @OA\Delete(
     *     path="/api/agenda/{agenda}",
     *     tags={"Agenda"},
     *     summary="Menghapus agenda",
     *     description="Menghapus agenda dari sistem",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="agenda",
     *         in="path",
     *         description="ID agenda",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Agenda berhasil dihapus",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Agenda berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Agenda tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Agenda tidak ditemukan")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Gagal menghapus agenda: error message")
     *         )
     *     )
     * )
     */
    public function destroy(Agenda $agenda): JsonResponse
    {
        try {
            $this->agendaService->deleteAgenda($agenda);

            return response()->json([
                'success' => true,
                'message' => 'Agenda berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus agenda: ' . $e->getMessage()
            ], 500);
        }
    }
}
