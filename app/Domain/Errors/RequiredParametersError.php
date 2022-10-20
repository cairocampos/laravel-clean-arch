<?php

namespace App\Domain\Errors;

use Exception;
use Throwable;

class RequiredParametersError extends Exception
{
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        $message = "Field $message is required";
        parent::__construct($message, $code, $previous);
    }
}
