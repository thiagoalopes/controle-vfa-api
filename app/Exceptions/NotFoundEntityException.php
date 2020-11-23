<?php

namespace App\Exceptions;

use Exception;

class NotFoundEntityException extends Exception
{
    public function __construct($message='')
    {
        parent::__construct($message);
    }
}