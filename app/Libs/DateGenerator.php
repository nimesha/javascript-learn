<?php

namespace App\Libs;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use App\Exception\SalesException;

class DateGenerator
{
    /**
     * 
     * @param date ,endDate,date
     * @return array ['2018-05-01','2018-05-02', '2018-05-03']
     * @throws \Exception
     */
    public static function between($startdate, $enddate)
    {

        $startdate = Carbon::create($startdate);
        $enddate = Carbon::create($enddate);

        if ($startdate->gt($enddate)) {
            throw new SalesException("The end date should be greater than the start date.");
        }

        try {
            $period = CarbonPeriod::create($startdate, $enddate);
        } catch (Exception $e) {

            throw new SalesException("Invalid date period");
        }

        $dates = [];

        foreach ($period as $date) {
            array_push($dates, $date->format('Y-m-d'));
        }

        //an array of dates
        return $dates;
    }
}
