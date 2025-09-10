<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Galeri;
use App\Models\Pejabat;
use App\Models\Pesan;
use App\Models\Slide;
use App\Models\Unduhan;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Dashboard",
 *     description="Dashboard management endpoints for admin panel statistics and overview"
 * )
 */
class DashboardController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/dashboard/stats",
     *     summary="Get dashboard statistics (Admin)",
     *     tags={"Dashboard"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Dashboard statistics retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Dashboard statistics retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="counts",
     *                     type="object",
     *                     @OA\Property(property="berita", type="integer", example=25),
     *                     @OA\Property(property="agenda", type="integer", example=12),
     *                     @OA\Property(property="galeri", type="integer", example=18),
     *                     @OA\Property(property="pejabat", type="integer", example=8),
     *                     @OA\Property(property="pesan", type="integer", example=45),
     *                     @OA\Property(property="slide", type="integer", example=5),
     *                     @OA\Property(property="unduhan", type="integer", example=15),
     *                     @OA\Property(property="users", type="integer", example=3)
     *                 ),
     *                 @OA\Property(
     *                     property="recent_stats",
     *                     type="object",
     *                     @OA\Property(property="berita_this_month", type="integer", example=5),
     *                     @OA\Property(property="agenda_this_month", type="integer", example=3),
     *                     @OA\Property(property="pesan_this_month", type="integer", example=12),
     *                     @OA\Property(property="new_users_this_month", type="integer", example=1)
     *                 ),
     *                 @OA\Property(
     *                     property="status_summary",
     *                     type="object",
     *                     @OA\Property(property="active_slides", type="integer", example=4),
     *                     @OA\Property(property="published_berita", type="integer", example=20),
     *                     @OA\Property(property="upcoming_agenda", type="integer", example=8),
     *                     @OA\Property(property="unread_pesan", type="integer", example=15)
     *                 )
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
        try {
            // Basic counts
            $counts = [
                'berita' => Berita::count(),
                'agenda' => Agenda::count(),
                'galeri' => Galeri::count(),
                'pejabat' => Pejabat::count(),
                'pesan' => Pesan::count(),
                'slide' => Slide::count(),
                'unduhan' => Unduhan::count(),
                'users' => User::count()
            ];

            // Recent statistics (this month)
            $thisMonth = now()->startOfMonth();
            $recent_stats = [
                'berita_this_month' => Berita::where('created_at', '>=', $thisMonth)->count(),
                'agenda_this_month' => Agenda::where('created_at', '>=', $thisMonth)->count(),
                'pesan_this_month' => Pesan::where('created_at', '>=', $thisMonth)->count(),
                'new_users_this_month' => User::where('created_at', '>=', $thisMonth)->count()
            ];

            // Status summary
            $status_summary = [
                'active_slides' => Slide::where('status', 'aktif')->count(),
                'published_berita' => Berita::where('status', 'published')->count(),
                'upcoming_agenda' => Agenda::where('tanggal_agenda', '>=', now())->count(),
                'unread_pesan' => Pesan::where('status', 'belum_dibaca')->count()
            ];

            return response()->json([
                'message' => 'Dashboard statistics retrieved successfully',
                'data' => [
                    'counts' => $counts,
                    'recent_stats' => $recent_stats,
                    'status_summary' => $status_summary
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve dashboard statistics',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/dashboard/recent-activities",
     *     summary="Get recent activities (Admin)",
     *     tags={"Dashboard"},
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Number of activities to retrieve",
     *         @OA\Schema(type="integer", default=10, minimum=1, maximum=50)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recent activities retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Recent activities retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="type", type="string", example="berita"),
     *                     @OA\Property(property="action", type="string", example="created"),
     *                     @OA\Property(property="title", type="string", example="New article published"),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="user", type="string", example="Admin User")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function recentActivities(Request $request): JsonResponse
    {
        try {
            $limit = $request->get('limit', 10);
            $limit = min(max($limit, 1), 50); // Ensure limit is between 1 and 50

            $activities = collect();

            // Recent Berita
            $recentBerita = Berita::with('user')
                ->latest()
                ->take($limit)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'berita',
                        'action' => 'created',
                        'title' => $item->judul,
                        'created_at' => $item->created_at,
                        'user' => $item->user ? $item->user->name : 'System'
                    ];
                });

            // Recent Agenda
            $recentAgenda = Agenda::with('user')
                ->latest()
                ->take($limit)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'agenda',
                        'action' => 'created',
                        'title' => $item->judul,
                        'created_at' => $item->created_at,
                        'user' => $item->user ? $item->user->name : 'System'
                    ];
                });

            // Recent Pesan
            $recentPesan = Pesan::latest()
                ->take($limit)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'pesan',
                        'action' => 'received',
                        'title' => 'Message from ' . $item->nama,
                        'created_at' => $item->created_at,
                        'user' => 'Public'
                    ];
                });

            // Combine and sort activities
            $activities = $activities
                ->merge($recentBerita)
                ->merge($recentAgenda)
                ->merge($recentPesan)
                ->sortByDesc('created_at')
                ->take($limit)
                ->values();

            return response()->json([
                'message' => 'Recent activities retrieved successfully',
                'data' => $activities
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve recent activities',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/dashboard/summary",
     *     summary="Get dashboard summary with charts data (Admin)",
     *     tags={"Dashboard"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Dashboard summary retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Dashboard summary retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(
     *                     property="monthly_stats",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="month", type="string", example="2025-01"),
     *                         @OA\Property(property="berita", type="integer", example=5),
     *                         @OA\Property(property="agenda", type="integer", example=3),
     *                         @OA\Property(property="pesan", type="integer", example=12)
     *                     )
     *                 ),
     *                 @OA\Property(
     *                     property="content_distribution",
     *                     type="object",
     *                     @OA\Property(property="berita", type="integer", example=25),
     *                     @OA\Property(property="agenda", type="integer", example=12),
     *                     @OA\Property(property="galeri", type="integer", example=18),
     *                     @OA\Property(property="unduhan", type="integer", example=15)
     *                 ),
     *                 @OA\Property(
     *                     property="popular_content",
     *                     type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="type", type="string", example="berita"),
     *                         @OA\Property(property="title", type="string", example="Popular Article"),
     *                         @OA\Property(property="views", type="integer", example=150)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function summary(): JsonResponse
    {
        try {
            // Monthly statistics for the last 6 months
            $monthlyStats = collect();
            for ($i = 5; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $monthStart = $month->copy()->startOfMonth();
                $monthEnd = $month->copy()->endOfMonth();

                $monthlyStats->push([
                    'month' => $month->format('Y-m'),
                    'berita' => Berita::whereBetween('created_at', [$monthStart, $monthEnd])->count(),
                    'agenda' => Agenda::whereBetween('created_at', [$monthStart, $monthEnd])->count(),
                    'pesan' => Pesan::whereBetween('created_at', [$monthStart, $monthEnd])->count()
                ]);
            }

            // Content distribution
            $contentDistribution = [
                'berita' => Berita::count(),
                'agenda' => Agenda::count(),
                'galeri' => Galeri::count(),
                'unduhan' => Unduhan::count()
            ];

            // Popular content (simplified - you can add views tracking later)
            $popularContent = collect();

            // Recent popular berita (by creation date as proxy)
            $popularBerita = Berita::latest()->take(3)->get()->map(function ($item) {
                return [
                    'type' => 'berita',
                    'title' => $item->judul,
                    'views' => rand(50, 200) // Placeholder - implement actual view tracking
                ];
            });

            // Recent popular agenda
            $popularAgenda = Agenda::latest()->take(2)->get()->map(function ($item) {
                return [
                    'type' => 'agenda',
                    'title' => $item->judul,
                    'views' => rand(30, 150)
                ];
            });

            $popularContent = $popularContent->merge($popularBerita)->merge($popularAgenda);

            return response()->json([
                'message' => 'Dashboard summary retrieved successfully',
                'data' => [
                    'monthly_stats' => $monthlyStats,
                    'content_distribution' => $contentDistribution,
                    'popular_content' => $popularContent
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve dashboard summary',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
