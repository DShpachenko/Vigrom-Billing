<?php

namespace App\Exceptions;

use Exception;

/**
 * Class BillingException
 * @package App\Exceptions
 */
class BillingException extends Exception
{
    public const SERVER_ERROR = 5;

    /**
     * ValidationException constructor.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code = self::SERVER_ERROR)
    {
        parent::__construct($message, $code);
    }
}
