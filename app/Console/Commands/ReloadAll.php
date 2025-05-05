<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ReloadAll extends Command
{
    protected $signature = 'reload:all';
    protected $description = 'Reload the application by migrating fresh, clearing caches, and restarting queues.';

    public function handle()
    {
        $this->info('Starting the reload process...');

        // Delete uploaded files
        if (Storage::disk('public')->exists('uploads')) {
            Storage::disk('public')->deleteDirectory('uploads');
            $this->info('Uploaded files deleted from public storage.');
        } else {
            $this->info('No uploaded files found in public storage to delete.');
        }

        // Migrate Fresh
        $this->call('migrate:fresh');
        $this->info('Database migrated fresh.');

        // Clear config cache
        $this->call('config:cache');
        $this->info('Config cache cleared.');

        // Clear route cache
        $this->call('route:cache');
        $this->info('Route cache cleared.');

        // Clear view cache
        $this->call('view:clear');
        $this->info('View cache cleared.');

        // Clear application cache
        $this->call('cache:clear');
        $this->info('Application cache cleared.');

        // Clear optimizations
        $this->call('optimize:clear');
        $this->info('All optimization caches cleared.');

        $this->call('queue:clear');
        $this->info('Pending queued jobs cleared.');

        $this->call('queue:flush');
        $this->info('Failed jobs flushed.');

        // Restart queue workers
        $this->call('queue:restart');
        $this->info('All queue workers restarted.');

        $this->info('Reload process completed successfully!');
    }
}
