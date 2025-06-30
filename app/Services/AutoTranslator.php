<?php

namespace App\Services;

use Illuminate\Translation\Translator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class AutoTranslator
{
    protected $translator;
    protected $langPath;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
        $this->langPath = resource_path('lang');
    }

    public function get($key, array $replace = [], $locale = null)
    {
        $locale = $locale ?: App::getLocale();

        // Try to get translation normally
        $translation = $this->translator->get($key, $replace, $locale);

        // If translation not found (returns the key itself)
        if ($translation === $key) {
            $this->createMissingTranslation($key);
        }

        return $translation;
    }

    protected function createMissingTranslation($key)
    {
        // Get all supported locales
        $locales = ['en', 'kh'];

        foreach ($locales as $locale) {
            try {
                $filePath = $this->langPath . '/' . $locale . '.json';

                // Create directory if not exists
                if (!File::exists($this->langPath)) {
                    File::makeDirectory($this->langPath, 0755, true);
                }

                // Read existing translations
                $translations = [];
                if (File::exists($filePath)) {
                    $content = File::get($filePath);

                    // Validate JSON before decoding
                    if (!empty($content)) {
                        $translations = json_decode($content, true);

                        // Check for JSON errors
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            Log::error("Invalid JSON in {$filePath}: " . json_last_error_msg());

                            // Backup corrupted file
                            File::copy($filePath, $filePath . '.backup.' . time());

                            // Start with empty translations
                            $translations = [];
                        }
                    }
                }

                // Add new key if not exists
                if (!isset($translations[$key])) {
                    // Clean the key to prevent JSON issues
                    $cleanKey = $this->cleanJsonString($key);
                    $translations[$cleanKey] = $cleanKey;

                    // Sort keys alphabetically
                    ksort($translations);

                    // Write back to file with proper encoding
                    $jsonContent = json_encode(
                        $translations,
                        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                    );

                    // Ensure valid JSON before writing
                    if ($jsonContent !== false) {
                        File::put($filePath, $jsonContent);
                    } else {
                        Log::error("Failed to encode JSON for {$filePath}");
                    }
                }
            } catch (\Exception $e) {
                Log::error("Error creating translation for '{$key}' in {$locale}: " . $e->getMessage());
            }
        }
    }

    protected function cleanJsonString($string)
    {
        // Remove any control characters that might break JSON
        $string = preg_replace('/[\x00-\x1F\x7F]/u', '', $string);

        // Ensure proper UTF-8 encoding
        if (!mb_check_encoding($string, 'UTF-8')) {
            $string = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
        }

        return $string;
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->translator, $method], $arguments);
    }
}
