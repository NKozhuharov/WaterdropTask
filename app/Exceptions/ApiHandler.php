<?php
namespace App\Exceptions;

use Dingo\Api\Exception\Handler as DingoHandler;
use Illuminate\Auth\AuthenticationException;

class ApiHandler extends DingoHandler
{
    /**
     * Override the function to handle AuthenticationException with 403 header
     *
     * @param \Exception|\Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function handle($exception)
    {
        if (get_class($exception) === AuthenticationException::class) {
            return response()->json(['message' => $exception->getMessage()], 403);
        }

        return parent::handle($exception);
    }
}
