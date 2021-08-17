<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Override the function to implement authentication with environmental variable APP_SECRET
     *
     * @param Request $request
     * @param array $guards
     * @return void|null
     * @throws AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if ($request->header('secret') === env('APP_SECRET')) {
            return NULL;
        }
        $this->unauthenticated($request, $guards);
    }

    /**
     * Override function to remove redirect
     *
     * @param Request $request
     * @param array $guards
     * @throws AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException('Unauthenticated');
    }
}
