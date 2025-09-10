<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\VisiMisi;
use App\Services\VisiMisiService;

class ToggleVisiMisiActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visi-misi:toggle {type} {id?} {--all} {--status=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toggle active status of visi misi items';

    protected VisiMisiService $visiMisiService;

    public function __construct(VisiMisiService $visiMisiService)
    {
        parent::__construct();
        $this->visiMisiService = $visiMisiService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $id = $this->argument('id');
        $all = $this->option('all');
        $status = $this->option('status');

        // Validate type
        $validTypes = array_keys(VisiMisi::getTypes());
        if (!in_array($type, $validTypes)) {
            $this->error("Invalid type. Valid types: " . implode(', ', $validTypes));
            return 1;
        }

        if ($all) {
            // Toggle all items of specific type
            $items = VisiMisi::where('type', $type)->get();

            if ($items->isEmpty()) {
                $this->info("No {$type} items found.");
                return 0;
            }

            $newStatus = null;
            if ($status !== null) {
                $newStatus = in_array(strtolower($status), ['active', 'true', '1']) ? true : false;
            }

            foreach ($items as $item) {
                $item->update([
                    'is_active' => $newStatus !== null ? $newStatus : !$item->is_active
                ]);
            }

            $this->visiMisiService->clearCache();

            $statusText = $newStatus !== null ? ($newStatus ? 'activated' : 'deactivated') : 'toggled';
            $this->info("All {$type} items have been {$statusText}.");

        } else if ($id) {
            // Toggle specific item
            $item = VisiMisi::where('type', $type)->find($id);

            if (!$item) {
                $this->error("No {$type} item found with ID {$id}.");
                return 1;
            }

            if ($status !== null) {
                $newStatus = in_array(strtolower($status), ['active', 'true', '1']) ? true : false;
            } else {
                $newStatus = !$item->is_active;
            }

            $item->update(['is_active' => $newStatus]);

            $this->visiMisiService->clearCache();

            $statusText = $newStatus ? 'activated' : 'deactivated';
            $this->info("Item '{$item->title}' has been {$statusText}.");

        } else {
            // Show current status
            $items = VisiMisi::where('type', $type)->get(['id', 'title', 'is_active']);

            if ($items->isEmpty()) {
                $this->info("No {$type} items found.");
                return 0;
            }

            $this->info("Current {$type} items status:");
            $this->table(
                ['ID', 'Title', 'Status'],
                $items->map(fn($item) => [
                    $item->id,
                    Str::limit($item->title, 50),
                    $item->is_active ? '✅ Active' : '❌ Inactive'
                ])
            );
        }

        return 0;
    }
}
