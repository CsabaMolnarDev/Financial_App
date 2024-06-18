<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //

            Log::error($e->getMessage(), ['exception' => $e]);
        });
        
    }
    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        // Customize handling of specific exceptions

        if ($e instanceof ModelNotFoundException) {
            return response()->view('errors.404', [], 404);
        }

        if ($e instanceof AuthorizationException) {
            return response()->view('errors.403', [], 403);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        if ($e instanceof HttpException) {
            return response()->view('errors.generic', ['message' => $e->getMessage()], $e->getStatusCode());
        }

        // Default handling
        return parent::render($request, $e);
    }
}
