<?php
namespace App\Exceptions;

use Exception;

class ViewNotFoundException extends Exception
{
    protected $message = '404 View Not Found';
}