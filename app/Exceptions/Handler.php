<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Jiannei\Response\Laravel\Support\Facades\Response;
use Jiannei\Response\Laravel\Support\Traits\ExceptionTrait;
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
        $this->reportable(function (Throwable $e) {
            // 
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    // public function render($request, Exception $exception)
    // {
    //     // return parent::render($request, $exception);
    //     if ($exception->getMessage() == '') {
    //         // $res = Utils::integradeResponseMessage(ResponseUtils::APINoFound(), false);
    //         return Response::fail($message = 'API No Found', $code = 404, $errors = '');
    //     } else {
    //         return Response::fail($message = 'Something Wrong', $code = 401, $errors = $exception->getMessage());
    //     }
    // }
}
