<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return $this->errorResponse("Authentication failed.", 401);
        }

        if ($exception instanceof AuthorizationException) {
            return $this->errorResponse("Authorization failed.", 403);
        }

        if ($exception instanceof ValidationException) {
            return $this->errorResponse($exception->validator->errors()->first(), 422);
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->errorResponse('Specified resource not found.', 404);
        }

         if (config('app.debug')) {
             return parent::render($request, $exception);
         }

        return $this->errorResponse('Service unavailable.', 500);
    }

    /**
     * @param mixed|null $data
     * @param string|null $message
     * @param int|null $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'=> 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param string|null $message
     * @param int|null $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function errorResponse($message, $code)
    {
        return response()->json([
            'status'=>'Error',
            'message' => $message,
        ], $code);
    }
}
