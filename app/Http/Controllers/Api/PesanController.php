<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePesanRequest;
use App\Http\Requests\UpdatePesanRequest;
use App\Http\Resources\PesanCollection;
use App\Http\Resources\PesanResource;
use App\Models\Pesan;
use App\Services\PesanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Tag(
 *     name="Pesan",
 *     description="API endpoints for contact message management"
 * )
 */
class PesanController extends Controller
{
    protected $pesanService;

    public function __construct(PesanService $pesanService)
    {
        $this->middleware('auth:sanctum')->except(['publicStore']);
        $this->pesanService = $pesanService;
    }

    /**
     * @OA\Post(
     *     path="/api/public/pesan",
     *     tags={"Pesan"},
     *     summary="Send contact message (public)",
     *     description="Send a contact message from public users without authentication",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"nama_pengirim", "email_pengirim", "tipe_pesan", "subjek", "isi_pesan"},
     *                 @OA\Property(property="nama_pengirim", type="string", example="John Doe", description="Sender name"),
     *                 @OA\Property(property="email_pengirim", type="string", format="email", example="john.doe@example.com", description="Sender email"),
     *                 @OA\Property(property="telepon", type="string", example="081234567890", description="Phone number (optional)"),
     *                 @OA\Property(property="tipe_pesan", type="string", enum={"pengaduan", "pertanyaan", "saran", "lainnya"}, example="pertanyaan", description="Message type"),
     *                 @OA\Property(property="subjek", type="string", example="Pertanyaan tentang perizinan bangunan", description="Message subject"),
     *                 @OA\Property(property="isi_pesan", type="string", example="Saya ingin bertanya tentang prosedur perizinan bangunan...", description="Message content")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Message sent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/PesanResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Pesan berhasil dikirim")
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
     *                 @OA\Property(property="nama_pengirim", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="email_pengirim", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="subjek", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="isi_pesan", type="array", @OA\Items(type="string"))
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
    public function publicStore(StorePesanRequest $request): JsonResponse
    {
        try {
            // Log activity untuk monitoring
            Log::info('Contact form submission attempt', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'email' => $request->email_pengirim,
            ]);

            $pesan = $this->pesanService->createPesan($request->validated());

            // Log successful submission
            Log::info('Contact form submitted successfully', [
                'pesan_id' => $pesan->id,
                'email' => $pesan->email_pengirim,
            ]);

            return response()->json([
                'data' => new PesanResource($pesan),
                'success' => true,
                'message' => 'Pesan berhasil dikirim'
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation failures untuk monitoring potential attacks
            Log::warning('Contact form validation failed', [
                'ip' => $request->ip(),
                'errors' => $e->errors(),
            ]);
            throw $e;
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Contact form submission failed', [
                'ip' => $request->ip(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi nanti.'
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/pesan",
     *     tags={"Pesan"},
     *     summary="Get list of messages (admin)",
     *     description="Returns paginated list of all contact messages with authentication required",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search messages by sender name, email, subject, or content",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter by status",
     *         required=false,
     *         @OA\Schema(type="string", enum={"unread", "read", "replied"})
     *     ),
     *     @OA\Parameter(
     *         name="tipe_pesan",
     *         in="query",
     *         description="Filter by message type",
     *         required=false,
     *         @OA\Schema(type="string", enum={"pengaduan", "pertanyaan", "saran", "lainnya"})
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
     *         description="Sort by field (id, nama_pengirim, email_pengirim, subjek, tipe_pesan, status, created_at, updated_at)",
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
     *         description="List of messages",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/PesanResource")),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data pesan berhasil diambil"),
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

            $pesan = $this->pesanService->getAllPesan($search, $perPage, $sort, $order);

            return response()->json(new PesanCollection($pesan));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/pesan/{pesan}",
     *     tags={"Pesan"},
     *     summary="Get single message by ID (admin)",
     *     description="Returns a single contact message with authentication required",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="pesan",
     *         in="path",
     *         description="Message ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Message details",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/PesanResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Data pesan berhasil diambil")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Message not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Pesan tidak ditemukan")
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
            $pesan = Pesan::findOrFail($id);

            // Automatically mark as read when viewed
            if ($pesan->status === 'unread') {
                $pesan = $this->pesanService->markAsRead($pesan);
            }

            return response()->json([
                'data' => new PesanResource($pesan),
                'success' => true,
                'message' => 'Data pesan berhasil diambil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan tidak ditemukan'
            ], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/pesan/{pesan}",
     *     tags={"Pesan"},
     *     summary="Update message status (admin)",
     *     description="Update message status or other details (admin only)",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="pesan",
     *         in="path",
     *         description="Message ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"status"},
     *                 @OA\Property(property="status", type="string", enum={"unread", "read", "replied"}, example="replied", description="Message status")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Message updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/PesanResource"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Status pesan berhasil diperbarui")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Message not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Pesan tidak ditemukan")
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
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'status' => 'required|in:unread,read,replied'
            ]);

            $pesan = Pesan::findOrFail($id);
            $pesan->update(['status' => $request->status]);

            return response()->json([
                'data' => new PesanResource($pesan->fresh()),
                'success' => true,
                'message' => 'Status pesan berhasil diperbarui'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui pesan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/pesan/{pesan}",
     *     tags={"Pesan"},
     *     summary="Delete message",
     *     description="Delete a contact message and its attachment (admin only)",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="pesan",
     *         in="path",
     *         description="Message ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Message deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Pesan berhasil dihapus")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Message not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Pesan tidak ditemukan")
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
            $pesan = Pesan::findOrFail($id);
            $this->pesanService->deletePesan($pesan);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dihapus'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pesan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/pesan/stats",
     *     tags={"Pesan"},
     *     summary="Get message statistics (admin)",
     *     description="Get statistics about contact messages",
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Message statistics",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Statistik pesan berhasil diambil"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="total_pesan", type="integer", example=150),
     *                 @OA\Property(property="unread_count", type="integer", example=25),
     *                 @OA\Property(property="read_count", type="integer", example=75),
     *                 @OA\Property(property="replied_count", type="integer", example=50)
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
    public function stats(): JsonResponse
    {
        try {
            $stats = $this->pesanService->getPesanStats();

            return response()->json([
                'success' => true,
                'message' => 'Statistik pesan berhasil diambil',
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }
}
