<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Pejabat;
use App\Models\Pesan;
use App\Models\ActivityLog;
use App\Services\BeritaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $beritaService;

    public function __construct(BeritaService $beritaService)
    {
        $this->beritaService = $beritaService;
    }

    public function index()
    {
        $beritaStats = $this->beritaService->getDashboardStats();
        $totalAgenda = Agenda::count();
        $totalPejabat = Pejabat::count();
        $pesanBelumDibaca = Pesan::where('status', 'Belum Dibaca')->count();

        // Get recent activity history
        $recentActivities = ActivityLog::getRecentActivity(8);

        // Get activity logs statistics for cleanup management
        try {
            $logsStats = ActivityLog::getLogsCount(30);
            $needsCleanup = ActivityLog::needsCleanup(30);
        } catch (\Exception $e) {
            // Fallback if there's an issue with activity logs
            $logsStats = [
                'total_logs' => 0,
                'recent_logs' => 0,
                'old_logs' => 0,
            ];
            $needsCleanup = false;
            Log::warning('Failed to get activity logs stats: ' . $e->getMessage());
        }

        return view('admin.dashboard', [
            'totalBerita' => $beritaStats['total_berita'],
            'totalAgenda' => $totalAgenda,
            'totalPejabat' => $totalPejabat,
            'pesanBelumDibaca' => $pesanBelumDibaca,
            'recentActivities' => $recentActivities,
            'logsStats' => $logsStats,
            'needsCleanup' => $needsCleanup,
        ]);
    }

    /**
     * Cleanup old activity logs
     */
    public function cleanupActivityLogs(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:365'
        ]);

        $days = $request->input('days', 30);

        try {
            // Perform cleanup
            $deletedCount = ActivityLog::cleanup($days);

            // Log this activity
            ActivityLog::createLog(
                'cleanup',
                'ActivityLog',
                null,
                "Manual cleanup histori aktivitas",
                null,
                ['deleted_count' => $deletedCount, 'days' => $days],
                "Manual cleanup: Menghapus {$deletedCount} log aktivitas yang lebih lama dari {$days} hari"
            );

            return response()->json([
                'success' => true,
                'message' => "Berhasil menghapus {$deletedCount} log aktivitas",
                'deleted_count' => $deletedCount,
                'days' => $days
            ]);

        } catch (\Exception $e) {
            Log::error('Activity logs cleanup failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan cleanup: ' . $e->getMessage()
            ], 500);
        }
    }
}
