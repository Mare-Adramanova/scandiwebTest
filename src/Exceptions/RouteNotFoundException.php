<?php

namespace App\Exceptions;

use Throwable;

class RouteNotFoundException extends \Exception
{
    protected $message = '404 Not Found';

    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        return $this->message ?? $message;
    }
}