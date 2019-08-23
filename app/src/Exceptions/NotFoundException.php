<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    
    /**
     * @param string $message
     * @param integer $code
     * @param Throwable $previous
     */
    public function __construct(
        string $message = "",
        int $code = 404,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
