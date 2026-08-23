<?php

namespace App\Services;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Operations
{

    public static function decryptId($value)
        {
                return Crypt::decrypt($value);

        }

    public static function encryptId($value)
        {
            return Crypt::encrypt($value);
        }


}