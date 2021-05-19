<?php

namespace App\Reports\Generater\Csv;

use App\Reports\Generater\CsvReportInterface;
use App\Reports\TurnoverReport;

class Turnoverperbrand implements CsvReportInterface
{

    protected $dateRange;

    public function __construct(array $dateRange)
    {
        $this->dateRange = $dateRange;
    }

    public function export()
    {
        $body = [];
        $data =  (new TurnoverReport)->turnoverPerBrand($this->dateRange);
        $header = array_merge(['Brands ID', 'Brands'], $this->dateRange, ['Total Turnover[Per Brand]'], ['Total Turnover without VAT 21% [Per Brand]']);


        foreach ($data as $row) {
            $turnoverDays = [];

            foreach ($row['turnover'] as $perday) {
                array_push($turnoverDays, $perday['turnover']);
            }
            $net = 0;

            if ($row['total_without_vat'] > 0)
                $net = round($row['total_without_vat'], 2);

            $line = array_merge([$row['id'], $row['name']], $turnoverDays, [$row['total'], $net]);
            array_push($body, $line);
        }


        $file_name = 'total-turnover-per-brand.csv';

        return compact('header', 'body', 'file_name');
    }
}
