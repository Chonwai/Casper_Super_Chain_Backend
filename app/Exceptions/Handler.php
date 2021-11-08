<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Jiannei\Response\Laravel\Support\Traits\ExceptionTrait;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ExceptionTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $exception) {
            //
        });

        $this->renderable(function (Throwable $exception) {
            $response = $this->handleException($exception);
            return $response;
        });
    }

    public function handleException(Exception $exception)
    {

        if ($exception instanceof MethodNotAllowedHttpException) {
            return Response::fail($message = $exception->getMessage(), $code = $exception->getCode() ?: 405, $errors = 'The specified method for the request is invalid.');
        }

        if ($exception instanceof NotFoundHttpException) {
            return Response::fail($message = $exception->getMessage(), $code = $exception->getCode() ?: 404, $errors = 'The specified URL cannot be found.');
        }

        if ($exception instanceof HttpException) {
            return Response::fail($message = $exception->getMessage(), $code = $exception->getCode() ?: 400, $errors = $exception->getMessage());
        }

        return Response::fail($message = $exception->getMessage(), $code = $exception->getCode() ?: 500, $errors = 'Unexpected Exception. Try later');
    }
}
