<?php

namespace App\Exceptions;

use BadMethodCallException;
use ErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;
use TypeError;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

      /**
     * Report or log an exception.
     *
     * @param  Throwable  $exception
     * @return void
     *
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }


     /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedException) {
            $message =  (config('app.env') === 'production') ?
                'Unauthorised Request' :
                $exception->getMessage();
            return $this->exceptionError($exception, $message, 403);
        }

        if ($exception instanceof \InvalidArgumentException) {
            $message =  (config('app.env') === 'production') ?
                config('constants.default_error_message') :
                'Exception: ' . $exception->getMessage();
            return $this->exceptionError($exception, $message, 400);
        }
        if ($exception instanceof ThrottleRequestsException) {
            $message =  (config('app.env') === 'production') ?
                'Too Many Attempts.' :
                'Exception: ' . $exception->getMessage();
            return $this->exceptionError($exception, $message, 429);
        }

        if ($exception instanceof TypeError) {
            $message =  (config('app.env') === 'production') ?
                'Type Error, Please try again' :
                'Type Error: ' . $exception->getMessage();
            return $this->exceptionError($exception, $message, 400);
        }

        if ($exception instanceof ErrorException) {
            $message =  (config('app.env') === 'production') ?
                'Error Exception, Please try again' :
                'Error Exception: ' . $exception->getMessage();
            return $this->exceptionError($exception, $message, 400);
        }
        if ($exception instanceof BadMethodCallException) {
            $message =  (config('app.env') === 'production') ?
                'Error with a method call' :
                'Error with a method call: ' . $exception->getMessage();
            return $this->exceptionError($exception, $message, 500);
        }
        if ($exception instanceof AuthenticationException) {
            $message =  (config('app.env') === 'production') ?
                'Unauthenticated' :
                $exception->getMessage();
            return $this->exceptionError($exception, $message, 401);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            $message =  (config('app.env') === 'production') ?
                config('constants.default_error_message') :
                'Exception: ' . $exception->getMessage();

            return $this->exceptionError($exception, $message, 405);
        }


        if ($exception instanceof BindingResolutionException) {
            $message =  (config('app.env') === 'production') ?
                config('constants.default_error_message') :
                'Exception: ' . $exception->getMessage();

            return $this->exceptionError($exception, $message, 405);
        }

        return parent::render($request, $exception);
    }


    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param Throwable $exception
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function exceptionError(Throwable $exception, string $message, int $statusCode = 400): JsonResponse
    {
        if (config('app.env') === 'production') {
            return response()->json([
                'status' => 'error',
                'data' => [],
                'message' => $message
            ], $statusCode);
        }
        return response()->json([
            'status' => 'error',
            'data' => [],
            'message' => $message,
            // 'trace' => $exception->getTrace()
        ], $statusCode);
    }
}
