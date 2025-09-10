<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegenerateApiDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:docs:generate {--clean : Clean cache before generation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate API documentation with optional cache cleaning';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔄 Starting API documentation regeneration...');

        if ($this->option('clean')) {
            $this->info('🧹 Cleaning caches...');

            // Clear various caches
            $this->call('cache:clear');
            $this->call('config:clear');
            $this->call('route:clear');
            $this->call('view:clear');

            $this->info('✅ Caches cleared successfully');
        }

        // Generate API documentation
        $this->info('📚 Generating API documentation...');
        $this->call('l5-swagger:generate');

        // Check if docs were generated successfully
        $docsPath = storage_path('api-docs/api-docs.json');
        if (file_exists($docsPath)) {
            $docSize = filesize($docsPath);
            $this->info("✅ API documentation generated successfully ($docSize bytes)");

            // Show access URLs
            $baseUrl = config('app.url');
            $this->line('');
            $this->info('📖 Access your API documentation at:');
            $this->line("   • Swagger UI: {$baseUrl}/api/documentation");
            $this->line("   • JSON: {$baseUrl}/docs/api-docs.json");
            $this->line('');

            // Show some stats
            $docsContent = json_decode(file_get_contents($docsPath), true);
            if ($docsContent && isset($docsContent['paths'])) {
                $endpointCount = count($docsContent['paths']);
                $this->info("📊 Documentation includes {$endpointCount} API endpoints");
            }

        } else {
            $this->error('❌ Failed to generate API documentation');
            return 1;
        }

        $this->info('🎉 API documentation regeneration completed!');
        return 0;
    }
}
