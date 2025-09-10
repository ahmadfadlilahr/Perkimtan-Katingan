<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'model',
        'model_id',
        'model_title',
        'old_values',
        'new_values',
        'description',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that performed the activity
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a new activity log entry
     */
    public static function createLog(
        string $action,
        ?string $model = null,
        ?int $modelId = null,
        ?string $modelTitle = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?string $description = null
    ): self {
        return self::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model' => $model,
            'model_id' => $modelId,
            'model_title' => $modelTitle,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'description' => $description ?? self::generateDescription($action, $model, $modelTitle),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Generate a human-readable description
     */
    private static function generateDescription(string $action, ?string $model, ?string $modelTitle): string
    {
        $actionMap = [
            'create' => 'Membuat',
            'update' => 'Memperbarui',
            'delete' => 'Menghapus',
            'login' => 'Login ke sistem',
            'logout' => 'Logout dari sistem',
            'view' => 'Melihat',
        ];

        $modelMap = [
            'Berita' => 'berita',
            'Agenda' => 'agenda',
            'Pejabat' => 'data pejabat',
            'Unduhan' => 'file unduhan',
            'Galeri' => 'foto galeri',
            'Slide' => 'slide',
            'User' => 'pengguna',
        ];

        $actionText = $actionMap[$action] ?? ucfirst($action);

        if ($model && $modelTitle) {
            $modelText = $modelMap[$model] ?? strtolower($model);
            return "{$actionText} {$modelText}: {$modelTitle}";
        } elseif ($model) {
            $modelText = $modelMap[$model] ?? strtolower($model);
            return "{$actionText} {$modelText}";
        }

        return $actionText;
    }

    /**
     * Get recent activity logs
     */
    public static function getRecentActivity(int $limit = 10)
    {
        return self::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get activity icon based on action
     */
    public function getIconAttribute(): string
    {
        return match($this->action) {
            'create' => '➕',
            'update' => '✏️',
            'delete' => '🗑️',
            'login' => '🔓',
            'logout' => '🔒',
            'view' => '👁️',
            default => '📝'
        };
    }

    /**
     * Get activity color based on action
     */
    public function getColorAttribute(): string
    {
        return match($this->action) {
            'create' => 'green',
            'update' => 'blue',
            'delete' => 'red',
            'login' => 'emerald',
            'logout' => 'gray',
            'view' => 'indigo',
            default => 'gray'
        };
    }

    /**
     * Cleanup old activity logs
     */
    public static function cleanup(int $days = 30): int
    {
        $cutoffDate = now()->subDays($days);

        return self::where('created_at', '<', $cutoffDate)->delete();
    }

    /**
     * Get logs count by date range
     */
    public static function getLogsCount(int $days = 30): array
    {
        $cutoffDate = now()->subDays($days);

        return [
            'old_logs' => self::where('created_at', '<', $cutoffDate)->count(),
            'recent_logs' => self::where('created_at', '>=', $cutoffDate)->count(),
            'total_logs' => self::count(),
        ];
    }

    /**
     * Check if cleanup is needed
     */
    public static function needsCleanup(int $days = 30): bool
    {
        $cutoffDate = now()->subDays($days);

        return self::where('created_at', '<', $cutoffDate)->exists();
    }
}
