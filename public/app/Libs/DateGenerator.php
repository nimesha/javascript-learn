<?php

namespace App\Libs;

use Carbon\CarbonPeriod;
use Exception;
use App\Exception\SalesException;

class DateGenerator
{

    public static function between($startdate, $enddate)
    {
        try {
            $period = CarbonPeriod::create($startdate, $enddate);
        } catch (Exception $e) {

            throw new SalesException ("Invalid date period");
        }

        $dates = [];

        foreach ($period as $date) {
            array_push($dates, $date->format('Y-m-d'));
        }

        //an array of dates
        return $dates;
    }
}
