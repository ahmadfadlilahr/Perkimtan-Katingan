<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Http\Resources\SlideResource;
use App\Models\Slide;
use App\Services\SlideService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Tag(
 *     name="Slides",
 *     description="API endpoints for slides/carousel management"
 * )
 *
 * @OA\Schema(
 *     schema="SlideResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="judul", type="string", example="Welcome to Our Website"),
 *     @OA\Property(property="subjudul", type="string", example="Providing excellent service"),
 *     @OA\Property(property="deskripsi", type="string", example="We are committed to delivering the best service for our community"),
 *     @OA\Property(property="tombol_teks", type="string", example="Learn More"),
 *     @OA\Property(property="tombol_link", type="string", example="https://example.com"),
 *     @OA\Property(property="gambar", type="object",
 *         @OA\Property(property="filename", type="string", example="slide1.jpg"),
 *         @OA\Property(property="url", type="string", example="http://localhost:8000/storage/slide/slide1.jpg"),
 *         @OA\Property(property="full_url", type="string", example="http://localhost:8000/storage/slide/slide1.jpg")
 *     ),
 *     @OA\Property(property="urutan", type="integer", example=1),
 *     @OA\Property(property="status", type="string", example="active"),
 *     @OA\Property(property="status_label", type="string", example="Aktif"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01 10:00:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01 12:00:00"),
 *     @OA\Property(property="created_at_human", type="string", example="2 hours ago"),
 *     @OA\Property(property="updated_at_human", type="string", example="1 hour ago")
 * )
 */
class SlideController extends Controller
{
    protected SlideService $slideService;

    public function __construct(SlideService $slideService)
    {
        $this->slideService = $slideService;
        $this->middleware('auth:sanctum')->except(['publicIndex', 'publicShow']);
    }

    /**
     * @OA\Get(
     *     path="/api/public/slide",
     *     summary="Get active slides for public display",
     *     tags={"Slides"},
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
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/SlideResource")),
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
            'per_page' => 'integer|min:1|max:100',
        ]);

        $perPage = $request->get('per_page', 10);
        $slides = $this->slideService->getActiveSlides($perPage);

        return SlideResource::collection($slides);
    }

    /**
     * @OA\Get(
     *     path="/api/public/slide/{id}",
     *     summary="Get a single active slide for public display",
     *     tags={"Slides"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Slide ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/SlideResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Slide not found or not active",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Slide tidak ditemukan")
     *         )
     *     )
     * )
     */
    public function publicShow(int $id): JsonResponse|SlideResource
    {
        $slide = Slide::where('id', $id)
            ->where('status', 'active')
            ->first();

        if (!$slide) {
            return response()->json([
                'message' => 'Slide tidak ditemukan'
            ], 404);
        }

        return new SlideResource($slide);
    }

    /**
     * @OA\Get(
     *     path="/api/slide",
     *     summary="Get all slides with search and pagination (Admin)",
     *     tags={"Slides"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term for judul, subjudul, or tombol_teks",
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
     *         @OA\Schema(type="string", enum={"id", "judul", "urutan", "status", "created_at", "updated_at"}, default="urutan")
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Sort order",
     *         required=false,
     *         @OA\Schema(type="string", enum={"asc", "desc"}, default="asc")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/SlideResource")),
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
            'sort' => 'nullable|string|in:id,judul,urutan,status,created_at,updated_at',
            'order' => 'nullable|string|in:asc,desc',
        ]);

        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort', 'urutan');
        $order = $request->get('order', 'asc');

        $slides = $this->slideService->getAllSlides($search, $perPage, $sort, $order);

        return SlideResource::collection($slides);
    }

    /**
     * @OA\Post(
     *     path="/api/slide",
     *     summary="Create a new slide (Admin)",
     *     tags={"Slides"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"judul", "gambar", "status"},
     *                 @OA\Property(property="judul", type="string", maxLength=255, description="Slide title"),
     *                 @OA\Property(property="subjudul", type="string", maxLength=255, description="Slide subtitle"),
     *                 @OA\Property(property="deskripsi", type="string", description="Slide description"),
     *                 @OA\Property(property="tombol_teks", type="string", maxLength=100, description="Button text"),
     *                 @OA\Property(property="tombol_link", type="string", format="url", maxLength=255, description="Button link"),
     *                 @OA\Property(property="gambar", type="string", format="binary", description="Slide image (max 5MB, jpeg/jpg/png/gif/webp)"),
     *                 @OA\Property(property="urutan", type="integer", minimum=1, description="Display order"),
     *                 @OA\Property(property="status", type="string", enum={"active", "inactive"}, description="Slide status")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Slide created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Slide berhasil dibuat"),
     *             @OA\Property(property="data", ref="#/components/schemas/SlideResource")
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
    public function store(StoreSlideRequest $request): JsonResponse
    {
        try {
            $slide = $this->slideService->createSlide($request->validated());

            return response()->json([
                'message' => 'Slide berhasil dibuat',
                'data' => new SlideResource($slide)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal membuat slide',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/slide/{slide}",
     *     summary="Get a single slide (Admin)",
     *     tags={"Slides"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="slide",
     *         in="path",
     *         description="Slide ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/SlideResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Slide not found"
     *     )
     * )
     */
    public function show(Slide $slide): SlideResource
    {
        return new SlideResource($slide);
    }

    /**
     * @OA\Post(
     *     path="/api/slide/{slide}",
     *     summary="Update a slide (Admin)",
     *     tags={"Slides"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="slide",
     *         in="path",
     *         description="Slide ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"judul", "status"},
     *                 @OA\Property(property="_method", type="string", enum={"PUT", "PATCH"}),
     *                 @OA\Property(property="judul", type="string", maxLength=255, description="Slide title"),
     *                 @OA\Property(property="subjudul", type="string", maxLength=255, description="Slide subtitle"),
     *                 @OA\Property(property="deskripsi", type="string", description="Slide description"),
     *                 @OA\Property(property="tombol_teks", type="string", maxLength=100, description="Button text"),
     *                 @OA\Property(property="tombol_link", type="string", format="url", maxLength=255, description="Button link"),
     *                 @OA\Property(property="gambar", type="string", format="binary", description="Slide image (max 5MB, jpeg/jpg/png/gif/webp)"),
     *                 @OA\Property(property="urutan", type="integer", minimum=1, description="Display order"),
     *                 @OA\Property(property="status", type="string", enum={"active", "inactive"}, description="Slide status")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Slide updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Slide berhasil diperbarui"),
     *             @OA\Property(property="data", ref="#/components/schemas/SlideResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Slide not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(UpdateSlideRequest $request, Slide $slide): JsonResponse
    {
        try {
            $updatedSlide = $this->slideService->updateSlide($slide, $request->validated());

            return response()->json([
                'message' => 'Slide berhasil diperbarui',
                'data' => new SlideResource($updatedSlide)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui slide',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/slide/{slide}",
     *     summary="Delete a slide (Admin)",
     *     tags={"Slides"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="slide",
     *         in="path",
     *         description="Slide ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Slide deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Slide berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Slide not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Failed to delete slide"
     *     )
     * )
     */
    public function destroy(Slide $slide): JsonResponse
    {
        try {
            $success = $this->slideService->deleteSlide($slide);

            if (!$success) {
                return response()->json([
                    'message' => 'Gagal menghapus slide'
                ], 500);
            }

            return response()->json([
                'message' => 'Slide berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus slide',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/slide/reorder",
     *     summary="Reorder slides position (Admin)",
     *     tags={"Slides"},
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="slides",
     *                     type="array",
     *                     @OA\Items(
     *                         @OA\Property(property="id", type="integer", description="Slide ID"),
     *                         @OA\Property(property="urutan", type="integer", description="New order position")
     *                     ),
     *                     description="Array of slides with new order"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Slides reordered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Urutan slide berhasil diperbarui")
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
    public function reorder(Request $request): JsonResponse
    {
        $request->validate([
            'slides' => 'required|array',
            'slides.*.id' => 'required|integer|exists:slides,id',
            'slides.*.urutan' => 'required|integer|min:1',
        ]);

        $success = $this->slideService->reorderSlides($request->slides);

        if (!$success) {
            return response()->json([
                'message' => 'Gagal mengubah urutan slide'
            ], 500);
        }

        return response()->json([
            'message' => 'Urutan slide berhasil diperbarui'
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/slide/{slide}/toggle-status",
     *     summary="Toggle slide status (Admin)",
     *     tags={"Slides"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="slide",
     *         in="path",
     *         description="Slide ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Status toggled successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Status slide berhasil diubah"),
     *             @OA\Property(property="data", ref="#/components/schemas/SlideResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Slide not found"
     *     )
     * )
     */
    public function toggleStatus(Slide $slide): JsonResponse
    {
        $updatedSlide = $this->slideService->toggleStatus($slide);

        return response()->json([
            'message' => 'Status slide berhasil diubah',
            'data' => new SlideResource($updatedSlide)
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/slide/stats",
     *     summary="Get slide statistics (Admin)",
     *     tags={"Slides"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="total_slides", type="integer", description="Total number of slides"),
     *                 @OA\Property(property="active_slides", type="integer", description="Number of active slides"),
     *                 @OA\Property(property="inactive_slides", type="integer", description="Number of inactive slides")
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
        $stats = $this->slideService->getSlideStats();

        return response()->json([
            'data' => $stats
        ]);
    }
}
