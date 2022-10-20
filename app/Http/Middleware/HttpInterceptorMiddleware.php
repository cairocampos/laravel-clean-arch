<?php

namespace App\Http\Middleware;

use App\Domain\Errors\Either;
use App\Domain\Errors\NotFoundError;
use App\Domain\Errors\RequiredParametersError;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HttpInterceptorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $result = $next($request);
        $response = $result->original;
        if(!$response instanceof Either) {
            return $result;
        }

        if($response->hasError()) {
            $error = $response->getErrors()[0];
            return $this->throwException($error);
        }
        $result->setStatusCode($result->getStatusCode());
        $result->setData($response->result());
        return $result;
    }

    private function throwException($error)
    {
        return match(get_class($error)) {
            NotFoundError::class => throw new HttpException(Response::HTTP_NOT_FOUND, $error->getMessage(), $error),
            default => throw new HttpException(Response::HTTP_BAD_REQUEST, $error->getMessage(), $error)
        };
    }
}
