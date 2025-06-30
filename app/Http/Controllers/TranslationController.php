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
