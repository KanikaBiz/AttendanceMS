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
