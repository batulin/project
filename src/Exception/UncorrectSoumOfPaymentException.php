<?php

namespace App\Exception;

use RuntimeException;

class UncorrectSoumOfPaymentException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Entered soum is not correct!', );
    }

}