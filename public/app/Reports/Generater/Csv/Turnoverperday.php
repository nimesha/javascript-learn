<?php

namespace App\Reports\Generater\Csv;

use App\Reports\TurnoverReport;
use App\Reports\Generater\CsvReportInterface;

class Turnoverperday implements CsvReportInterface
{

    protected $dateRange;

    public function __construct(array $dateRange)
    {
        $this->dateRange = $dateRange;
    }

    public function export()
    {

        $body = [];
        $data =  (new TurnoverReport)->Turnoverperday($this->dateRange);
        $header = array_merge(['Date', 'Total Turnover', 'Total Turnover without VAT 21%']);

        foreach ($data as $row) {

            if ($row['total_without_vat'] > 0)
                $net = round($row['total_without_vat'], 2);

            $line = [$row['date'], $row['turnover'], $net];
            array_push($body, $line);
        }

        $file_name = 'total-turnover-per-day.csv';

        return compact('header', 'body', 'file_name');
    }
}
