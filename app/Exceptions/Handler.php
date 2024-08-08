<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
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
        $this->reportable(function (Throwable $e) {
            //
        });
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
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getCode();
            if (view()->exists("errors.{$statusCode}")) {
                return response()->view("errors.{$statusCode}", [], $statusCode);
            }
        }

        if ($exception instanceof AuthorizationException) {
            return redirect()->route('login.showLoginForm')->withErrors('Huna ruhusa ya kufikia ukurasa huu.');
        }

        // if ($exception instanceof AuthenticationException) {
        //     return redirect()->route('login.showLoginForm')->withErrors('Tafadhali ingia ili kufikia ukurasa huu.');
        // }

        return parent::render($request, $exception);
    }
}
