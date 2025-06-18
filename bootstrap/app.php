<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function (Illuminate\Routing\Router $router) {
            $router->middleware('web')
                ->group(base_path('routes/web.php'));

            $router->middleware('web')
                ->group(base_path('routes/auth.php'));

            // Jika ada API:
            // $router->middleware('api')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            // HAPUS ATAU KOMENTARI BARIS DI BAWAH INI:
            // \App\Http\Middleware\HandleInertiaRequests::class, // <--- HAPUS ATAU KOMENTARI INI
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            // ... middleware lain jika ada
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
