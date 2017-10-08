<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
    \Illuminate\Auth\AuthenticationException::class,
    \Illuminate\Auth\Access\AuthorizationException::class,
    \Symfony\Component\HttpKernel\Exception\HttpException::class,
    \Illuminate\Database\Eloquent\ModelNotFoundException::class,
    \Illuminate\Session\TokenMismatchException::class,
    \Illuminate\Validation\ValidationException::class,
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
     ];       
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)
            return response(view('errors.404'), 404);
        elseif ($exception instanceof \Illuminate\Session\TokenMismatchException)
            return response('Session Expired! Please try again.',401);
        elseif ($exception instanceof \PDOException) {
            if ($exception->getCode() == 2002)
                return response(view('errors.db'), 500);
        }
        return parent::render($request, $exception);
    }
    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Exception  $e
     * @return mixed
     */
}
