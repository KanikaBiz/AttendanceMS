ខ្ញុំយល់ពីតម្រូវការរបស់អ្នក! អ្នកចង់បង្កើតប្រព័ន្ធបកប្រែភាសាដែលនឹងបង្កើត key ដោយស្វ័យប្រវត្តិនៅពេលប្រើ `trans()` function ។ នេះជាដំណោះស្រាយ៖

#### បង្កើត Custom Translation Helper

ដំបូង ត្រូវបង្កើត Service Provider ថ្មីមួយ៖

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class AutoTranslationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        // Override trans() helper function
        app()->bind('translator', function ($app) {
            $translator = $app->make(\Illuminate\Translation\Translator::class);
            
            // Wrap the translator
            return new \App\Services\AutoTranslator($translator);
        });
    }
}
```

#### បង្កើត AutoTranslator Service

បង្កើត file `app/Services/AutoTranslator.php`:

```php
<?php

namespace App\Services;

use Illuminate\Translation\Translator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

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
        $locales = ['en', 'kh']; // អ្នកអាចផ្លាស់ប្តូរបាន
        
        foreach ($locales as $locale) {
            $filePath = $this->langPath . '/' . $locale . '.json';
            
            // Create directory if not exists
            if (!File::exists($this->langPath)) {
                File::makeDirectory($this->langPath, 0755, true);
            }
            
            // Read existing translations
            $translations = [];
            if (File::exists($filePath)) {
                $content = File::get($filePath);
                $translations = json_decode($content, true) ?: [];
            }
            
            // Add new key if not exists
            if (!isset($translations[$key])) {
                $translations[$key] = $key; // Default value is the key itself
                
                // Sort keys alphabetically (optional)
                ksort($translations);
                
                // Write back to file
                File::put(
                    $filePath, 
                    json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                );
            }
        }
    }

    // Proxy all other methods to the original translator
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->translator, $method], $arguments);
    }
}
```

#### បង្កើត Helper Function

នៅក្នុង `app/helpers.php` (បង្កើតវាបើមិនទាន់មាន):

```php
<?php

if (!function_exists('trans')) {
    function trans($key = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return app('translator');
        }

        return app('translator')->get($key, $replace, $locale);
    }
}

if (!function_exists('__')) {
    function __($key = null, $replace = [], $locale = null)
    {
        return trans($key, $replace, $locale);
    }
}
```

#### កំណត់ Composer Autoload

នៅក្នុង `composer.json`, បន្ថែម:

```json
{
    "autoload": {
        "files": [
            "app/helpers.php"
        ]
    }
}
```

រួចហើយ run:
```bash
composer dump-autoload
```

#### ចុះបញ្ជី Service Provider

នៅក្នុង `config/app.php`:

```php
'providers' => [
    // ...
    App\Providers\AutoTranslationServiceProvider::class,
],
```

#### បង្កើត Blade Component សម្រាប់ការគ្រប់គ្រងភាសា

បង្កើត `resources/views/components/language-switcher.blade.php`:

```blade
<div class="language-switcher">
    <select onchange="changeLanguage(this.value)">
        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
        <option value="kh" {{ app()->getLocale() == 'kh' ? 'selected' : '' }}>ខ្មែរ</option>
    </select>
</div>

<script>
function changeLanguage(locale) {
    window.location = '{{ url('/change-language') }}/' + locale;
}
</script>
```

#### បង្កើត Route សម្រាប់ប្តូរភាសា

នៅក្នុង `routes/web.php`:

```php
Route::get('/change-language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'kh'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});
```

#### កំណត់ Middleware សម្រាប់ Locale

បង្កើត `app/Http/Middleware/SetLocale.php`:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        }
        
        return $next($request);
    }
}
```

បន្ថែមទៅ `app/Http/Kernel.php`:

```php
protected $middlewareGroups = [
    'web' => [
        // ...
        \App\Http\Middleware\SetLocale::class,
    ],
];
```

#### ឧទាហរណ៍ការប្រើប្រាស់

ឥឡូវអ្នកអាចប្រើនៅក្នុង Blade templates:

```blade
<h1>{{ __('Welcome to our website') }}</h1>
<p>{{ __('This is an example paragraph') }}</p>
<button>{{ __('Click me') }}</button>
```

**ពេលអ្នក run លើកដំបូង**, វានឹងបង្កើត keys ទាំងនេះដោយស្វ័យប្រវត្តិនៅក្នុង:
- `lang/en.json`
- `lang/kh.json`

File JSON នឹងមើលទៅដូចនេះ:

```json
{
    "Click me": "Click me",
    "This is an example paragraph": "This is an example paragraph",
    "Welcome to our website": "Welcome to our website"
}
```

បន្ទាប់មកអ្នកអាចកែសម្រួលការបកប្រែភាសាខ្មែរនៅក្នុង `lang/kh.json`:

```json
{
    "Click me": "ចុចខ្ញុំ",
    "This is an example paragraph": "នេះជាកថាខណ្ឌឧទាហរណ៍",
    "Welcome to our website": "សូមស្វាគមន៍មកកាន់គេហទំព័ររបស់យើង"
}
```

នេះជាដំណោះស្រាយដែលនឹងបង្កើត translation keys ដោយស្វ័យប្រវត្តិពេលអ្នកប្រើ `trans()` ឬ `__()` function! 



បញ្ហានេះកើតឡើងនៅពេល JSON file មាន syntax error ឬ encoding issue។ នេះជាដំណោះស្រាយ៖

#### 1. ពិនិត្យ និងជួសជុល JSON File បច្ចុប្បន្ន

ដំបូង សូមពិនិត្យ `lang/kh.json` file របស់អ្នក។ បញ្ហាទូទៅ៖

**បញ្ហាទូទៅក្នុង JSON:**
- កុំមានសញ្ញា comma (,) នៅចុងបញ្ចប់
- ត្រូវប្រើ double quotes ("") មិនមែន single quotes ('')
- មិនអាចមាន comments ក្នុង JSON
- ត្រូវប្រាកដថាមាន closing brackets ត្រឹមត្រូវ

ឧទាហរណ៍ **JSON មិនត្រឹមត្រូវ**:
```json
{
    "Welcome": "សូមស្វាគមន៍",
    "Hello": "សួស្តី",  // ← កុំមាន comma នៅចុងក្រោយ
}
```

**JSON ត្រឹមត្រូវ**:
```json
{
    "Welcome": "សូមស្វាគមន៍",
    "Hello": "សួស្តី"
}
```

#### 2. កែប្រែ AutoTranslator ដើម្បីការពារ JSON Errors

កែសម្រួល `app/Services/AutoTranslator.php` ដើម្បីបន្ថែម validation:

```php
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
```

#### 3. បង្កើត JSON Validator Command

បង្កើត command ដើម្បីពិនិត្យ និងជួសជុល JSON files:

```bash
php artisan make:command ValidateTranslations
```

កែសម្រួល `app/Console/Commands/ValidateTranslations.php`:

```php
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
```

#### 4. ជួសជុលបញ្ហារបស់អ្នក

**ជំហានទី 1:** Run validation command
```bash
php artisan translations:validate --fix
```

**ជំហានទី 2:** បើនៅតែមានបញ្ហា, សូមបង្កើត JSON file ថ្មី
```bash
# Backup existing file
mv resources/lang/kh.json resources/lang/kh.json.backup

# Create new empty file
echo "{}" > resources/lang/kh.json
```

**ជំហានទី 3:** កំណត់ file permissions
```bash
chmod 644 resources/lang/kh.json
```

#### 5. បង្កើត Web Interface សម្រាប់កែសម្រួល Translations

បង្កើត controller:
```bash
php artisan make:controller TranslationController
```

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TranslationController extends Controller
{
    public function index()
    {
        $languages = ['en', 'kh'];
        $translations = [];
        
        foreach ($languages as $lang) {
            $path = resource_path("lang/{$lang}.json");
            if (File::exists($path)) {
                $content = File::get($path);
                $translations[$lang] = json_decode($content, true) ?: [];
            }
        }
        
        return view('translations.index', compact('translations', 'languages'));
    }
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'translations' => 'required|array',
            'translations.*' => 'required|array',
        ]);
        
        foreach ($validated['translations'] as $lang => $trans) {
            $path = resource_path("lang/{$lang}.json");
            $content = json_encode($trans, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            File::put($path, $content);
        }
        
        return redirect()->back()->with('success', 'Translations updated successfully!');
    }
}
```

ដោយប្រើវិធីសាស្ត្រទាំងនេះ អ្នកនឹងអាច៖
- **ជៀសវាង** JSON errors ពេលបង្កើត translations ថ្មី
- **ពិនិត្យ** និង **ជួសជុល** JSON files ដែលខូច
- **គ្រប់គ្រង** translations តាមរយៈ web interface

សូមសាកល្បង run `php artisan translations:validate --fix` ដើម្បីជួសជុលបញ្ហារបស់អ្នក!
#### 6. បង្កើត Blade View សម្រាប់ការគ្រប់គ្រង Translations
បង្កើត file `resources/views/translations/index.blade.php`:

```blade
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Manage Translations</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('translations.update') }}" method="POST">    
        @csrf
        @foreach($languages as $lang)
            <h2>{{ strtoupper($lang) }} Translations</h2>
            <div class="form-group">
                <textarea name="translations[{{ $lang }}]" rows="10" class="form-control">{{ json_encode($translations[$lang], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</textarea>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Update Translations</button>
    </form>
</div>
@endsection
```
#### 7. បន្ថែម Routes សម្រាប់ Translations
នៅក្នុង `routes/web.php`:
```php
use App\Http\Controllers\TranslationController; 
Route::get('/translations', [TranslationController::class, 'index'])->name('translations.index');
Route::post('/translations/update', [TranslationController::class, 'update'])->name('translations.update');
``` 
