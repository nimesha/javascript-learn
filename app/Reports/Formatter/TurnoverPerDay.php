<?php

namespace App\Reports\Formatter;

use App\Reports\TurnoverReport;
use App\Reports\Formatter\FormatterReportInterface;

class TurnoverPerDay implements FormatterReportInterface
{

    protected $dateRange;

    public function __construct(array $dateRange)
    {
        $this->dateRange = $dateRange;
    }

    /**
     * @return array 
     */

    public function export()
    {

        $body = [];
        $data =  (new TurnoverReport)->turnoverperday($this->dateRange);
        $header = array_merge(['Date', 'Total Turnover', 'Total Turnover without VAT 21%']);

        foreach ($data as $row) {

            if ($row['total_without_vat'] > 0)
                $net = round($row['total_without_vat'], 2);

            $line = [$row['date'], $row['turnover'], $net];
            array_push($body, $line);
        }


        return compact('header', 'body');
    }
}
