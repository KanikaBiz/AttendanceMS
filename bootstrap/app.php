<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\LanguageSwitcher;
use App\Http\Middleware\PermissionMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Create a new Application instance
$app = Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
      PermissionMiddleware::class,
      LanguageSwitcher::class
    ]);
    // $middleware->alias([
    //   'subscribed' => PermissionMiddleware::class
    // ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    // Handle exceptions
  })
  ->create();

// Set the custom environment path
// $app->useEnvironmentPath(realpath(__DIR__ . '/../vendor/bin/'));

// Return the application instance
return $app;
