<?php

namespace App\Http;

use App\Http\Middleware\ApiAuth;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\InstalledCheck;
use App\Http\Middleware\JsonResponse;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\UpdatePending;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
    protected $middleware = [
        CheckForMaintenanceMode::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    protected $middlewareGroups = [
        'api' => [
            // 'throttle:60,1',
            'bindings',
            'json',
        ],
        'web' => [
            InstalledCheck::class,
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            //\Spatie\Pjax\Middleware\FilterIfPjax::class,
        ],
    ];
    protected $routeMiddleware = [
        'api.auth'       => ApiAuth::class,
        'auth'           => Authenticate::class,
        'auth.basic'     => AuthenticateWithBasicAuth::class,
        'bindings'       => SubstituteBindings::class,
        'can'            => Authorize::class,
        'guest'          => RedirectIfAuthenticated::class,
        'json'           => JsonResponse::class,
        'throttle'       => ThrottleRequests::class,
        'update_pending' => UpdatePending::class,
    ];
}
