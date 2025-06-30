<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ValidateTranslations extends Command
{
    protected $signature = 'translations:validate {--fix : Attempt to fix issues}';
    protected $description = 'Validate JSON translation files';

    public function handle()
    {
        $langPath = resource_path('lang');
        $files = File::glob($langPath . '/*.json');

        foreach ($files as $file) {
            $this->info("Checking: " . basename($file));

            $content = File::get($file);
            $decoded = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error("  ❌ Invalid JSON: " . json_last_error_msg());

                if ($this->option('fix')) {
                    $this->attemptFix($file);
                }
            } else {
                $this->info("  ✅ Valid JSON");

                // Check for common issues
                if (substr($content, -2) === ',}' || substr($content, -2) === ',]') {
                    $this->warn("  ⚠️  Trailing comma detected");

                    if ($this->option('fix')) {
                        $content = preg_replace('/,(\s*[}\]])/', '$1', $content);
                        File::put($file, $content);
                        $this->info("  ✅ Fixed trailing comma");
                    }
                }
            }
        }
    }

    protected function attemptFix($file)
    {
        $this->info("  Attempting to fix...");

        // Backup first
        File::copy($file, $file . '.backup');

        $content = File::get($file);

        // Try to fix common issues
        // Remove comments
        $content = preg_replace('!/\*.*?\*/!s', '', $content);
        $content = preg_replace('/\/\/.*$/m', '', $content);

        // Fix trailing commas
        $content = preg_replace('/,(\s*[}\]])/', '$1', $content);

        // Try to decode again
        $decoded = json_decode($content, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            // Re-encode properly
            $content = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            File::put($file, $content);
            $this->info("  ✅ Fixed successfully!");
        } else {
            $this->error("  ❌ Could not fix automatically. Please check manually.");
            $this->error("  Error: " . json_last_error_msg());
        }
    }
}
