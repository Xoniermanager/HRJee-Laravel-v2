<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        // if ($request->is('api/*')) {
        //     if ($e instanceof ModelNotFoundException) {
        //         return errorMessage('','Data not found');
        //     } elseif ($e instanceof NotFoundHttpException) {
        //         return errorMessage('','route not found');
              
        //     }
        // }
    }
}
