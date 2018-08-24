<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @inheritdoc
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @inheritdoc
     */
    public function render($request, Exception $exception)
    {
        // Make the message more understandable
        if ($exception instanceof ModelNotFoundException) {
            $model = array_last(explode('\\', $exception->getModel()));

            $message = sprintf('%s not found', $model);

            $exception = new ModelNotFoundException($message, $exception->getCode(), $exception);
        }

        return parent::render($request, $exception);
    }
}
