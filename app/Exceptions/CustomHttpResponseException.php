<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CustomHttpResponseException extends Exception
{
    public function __construct(
        string $message = 'An error occurred',
        int $statusCode = Response::HTTP_BAD_REQUEST
    ) {
        parent::__construct($message, $statusCode);
    }

    public function render()
    {
        return response()->json([
            'status' => 'error',
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
