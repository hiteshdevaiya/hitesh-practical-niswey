<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\Authenticate;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web.php',
            __DIR__ . '/../routes/admin.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\WebLocale::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $middleware->use([
            \App\Http\Middleware\TrustProxies::class,
            \Illuminate\Http\Middleware\HandleCors::class,
            \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
            \App\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        ]);

        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'key.check' => \App\Http\Middleware\ApiKeyCheck::class,
            'jwt.auth' => Authenticate::class,
        ]);

        $middleware->api(append: [
            'throttle:api',
            \App\Http\Middleware\ApiLocale::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    // ->withExceptions(function (Exceptions $exceptions) {
    //     $exceptions->reportable(function (Throwable $e) {});

    //     $exceptions->renderable(function (AuthenticationException $e, $request) {
    //         //handles the 500 error messages for unauthenticated users
    //         if ($request->is('api/*')) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Unauthenticated.',
    //             ], 401);
    //         }
    //     });

    //     $exceptions->renderable(function (AuthorizationException $e, $request) {
    //         if ($request->is('api/*')) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Unauthorized.',
    //             ], 401);
    //         }
    //     });

    //     $exceptions->renderable(function (HttpException $e, $request) {
    //         if ($request->is('api/*') && $e->getStatusCode() === 403) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Forbidden.',
    //             ], 403);
    //         }
    //     });

    //     $exceptions->renderable(function (ModelNotFoundException $e, $request) {
    //         //handles the 404 error messages data not found
    //         if ($request->is('api/*')) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Data Not Found.',
    //             ], 404);
    //         }
    //     });

    //     $exceptions->renderable(function (NotFoundHttpException $e, $request) {
    //         if ($request->is('api/*')) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Data Not Found.',
    //             ], 404);
    //         }
    //     });

    //     $exceptions->renderable(function (ValidationException $e, $request) {
    //         //handles the validation error messages for only apis
    //         if ($request->is('api/*')) {
    //             $validate_array = $e->errors();
    //             $error = [];

    //             if (empty($validate_array)) {
    //                 return $error;
    //             }

    //             foreach ($validate_array as $item) {
    //                 array_push($error, $item[0]);
    //             }

    //             $errors = implode("\n", $error);

    //             return response()->json([
    //                 'status' => false,
    //                 'message' => $errors,
    //             ], 422);
    //         }
    //     });

    //     $exceptions->renderable(function (Exception $e, $request) {
    //         //handles the 500 error messages for server error
    //         if ($request->is('api/*')) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => $e->getMessage(),
    //             ], 500);
    //         }
    //     });
    // })->create();
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (Throwable $e) {});

        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            //handles the 404 error messages and findOrFail as well
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data not found.',
                ], 200);
            }
        });

        $exceptions->renderable(function (AccessDeniedHttpException $e, $request) {
            //handles the 404 error messages and findOrFail as well
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data not found.',
                ], 200);
            }
        });

        $exceptions->renderable(function (ModelNotFoundException $e, $request) {
            //handles the 404 error messages and findOrFail as well
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Not Found.',
                ], 200);
            }
        });

        $exceptions->renderable(function (ValidationException $e, $request) {
            //handles the validation error messages for only apis
            if ($request->is('api/*')) {
                $validate_array = $e->errors();
                $error = [];

                if (empty($validate_array)) {
                    return $error;
                }

                foreach ($validate_array as $item) {
                    array_push($error, $item[0]);
                }

                $errors = implode("\n", $error);

                return response()->json([
                    'status' => false,
                    'message' => $errors,
                ]);
            }
        });
    })->create();
