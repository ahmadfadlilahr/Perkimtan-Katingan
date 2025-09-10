<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CleanupActivityLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity:cleanup {--days=30 : Number of days to keep logs} {--force : Force cleanup without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup old activity logs older than specified days (default: 30 days)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = (int) $this->option('days');
        $force = $this->option('force');

        // Validate days parameter
        if ($days < 1) {
            $this->error('Days must be a positive number greater than 0');
            return 1;
        }

        // Calculate cutoff date
        $cutoffDate = Carbon::now()->subDays($days);

        // Count logs to be deleted
        $logsToDelete = ActivityLog::where('created_at', '<', $cutoffDate)->count();

        if ($logsToDelete === 0) {
            $this->info("No activity logs older than {$days} days found.");
            return 0;
        }

        // Show information
        $this->line("<fg=yellow>Activity Logs Cleanup</>");
        $this->line("Cutoff date: <fg=cyan>{$cutoffDate->format('Y-m-d H:i:s')}</>");
        $this->line("Logs to delete: <fg=red>{$logsToDelete}</>");

        // Ask for confirmation unless forced
        if (!$force && !$this->confirm('Do you want to continue with the cleanup?')) {
            $this->info('Cleanup cancelled.');
            return 0;
        }

        // Perform cleanup with progress bar
        $this->info('Starting cleanup...');
        $progressBar = $this->output->createProgressBar($logsToDelete);
        $progressBar->start();

        // Delete in chunks to avoid memory issues
        $chunkSize = 1000;
        $deletedCount = 0;

        do {
            $deleted = ActivityLog::where('created_at', '<', $cutoffDate)
                ->limit($chunkSize)
                ->delete();

            $deletedCount += $deleted;
            $progressBar->advance($deleted);

        } while ($deleted > 0);

        $progressBar->finish();
        $this->newLine(2);

        // Show results
        $this->info("✅ Successfully deleted {$deletedCount} activity logs older than {$days} days.");

        // Show remaining count
        $remainingLogs = ActivityLog::count();
        $this->line("📊 Remaining activity logs: <fg=green>{$remainingLogs}</>");

        // Log this cleanup activity
        try {
            ActivityLog::createLog(
                'cleanup',
                'ActivityLog',
                null,
                "Cleanup histori aktivitas",
                null,
                ['deleted_count' => $deletedCount, 'days' => $days],
                "Menghapus {$deletedCount} log aktivitas yang lebih lama dari {$days} hari"
            );
        } catch (\Exception $e) {
            // Ignore if we can't log this activity (circular dependency)
        }

        return 0;
    }
}
