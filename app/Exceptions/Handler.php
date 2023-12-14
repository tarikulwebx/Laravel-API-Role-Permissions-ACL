<?php

namespace App\Exceptions;

use App\Http\Helpers\Helper;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


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
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, $request) {
            // Log::info('Exception class: ' . get_class($e));
            if ($e instanceof AccessDeniedHttpException) {
                // Log::info("UnauthorizedException caught");
                Helper::sendError("You do not have the required authorization.", [], 401);
            }
        });
    }
}
