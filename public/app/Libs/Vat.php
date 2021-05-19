<?php

namespace App\Libs;

use Carbon\CarbonPeriod;
use Exception;
use App\Exception\SalesException;

class Vat
{
    const vat = 21;
    
    public static function getVat()
    {
        return self::vat;
    }
}
