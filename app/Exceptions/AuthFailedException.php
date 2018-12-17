<?php

namespace App\Exceptions;

use Exception;

class AuthFailedException extends Exception
{
    public function report()
    {
    }
    public function render()
    {
        return response()->json([
            'message' => 'These Credentails do not match our records'
        ],422);
    }
}
