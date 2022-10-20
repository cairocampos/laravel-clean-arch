<?php

namespace App\Domain\Errors;

use Exception;
use Throwable;

class NotFoundError extends Exception
{
    public function __construct(string $message, int $id,  int $code = 0, Throwable $previous = null)
    {
        $message = "Resource $message not found with id: $id";
        parent::__construct($message, $code, $previous);
    }
}
