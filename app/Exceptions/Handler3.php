<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Testing\HttpException;
use Illuminate\Validation\ValidationException;
use function Psy\debug;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    use ApiResponser;

    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
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
        if($request->is('api/*')){
            if($exception instanceof ValidationException){
                $errors = $exception->validator->errors()->getMessages();
                $key= '';
                foreach ($errors as $error){
                    $key .= $error[0]."<br>";
                }


                return $this->errorResponse($key, 422);
            }

            if($exception instanceof ModelNotFoundException){
                $modelName = strtolower(class_basename($exception->getModel()));
                return $this->errorResponse("Doesn't exists any {$modelName} With this indicator", 404);
            }

            if($exception instanceof AuthenticationException){
                return $this->errorResponse("Unauthenticated", 401);
            }
            if($exception instanceof AuthorizationException){
                return $this->errorResponse($exception->getMessage(), 403);
            }
            if($exception instanceof MethodNotAllowedHttpException){
                return $this->errorResponse('The specified method for the request is invalid !', 405);
            }
            if($exception instanceof NotFoundHttpException){
                return $this->errorResponse('Sorry, The page you are looking for couldn\'t be found!' , 404);
            }
            if($exception instanceof HttpException){
                return $this->errorResponse($exception->getMessage() , $exception->getStatusCode());
            }
            if($exception instanceof QueryException){
                $errorCode = $exception->errorInfo[1];
                if($errorCode == 1451)
                {
                    return $this->errorResponse('Can\'t Remove this resource permanently. It\'s related with another resource ',409);
                }
            }

            return $this->errorResponse('Unexpected Exception, Please try again later', 500);

        }
//        if(config(app.debug)){
//            return parent::render($request, $exception);
//        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }

}
