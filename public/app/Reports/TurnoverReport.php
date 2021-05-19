<?php

namespace App\Reports;

use App\Repositories\SalesRepository;
use App\Exception\SalesException;
use App\Libs\Vat;
use App\Repositories\BrandRepository;
use Exception;

class TurnoverReport
{

    public function turnoverPerBrand(array $dateRange)
    {
        $sales = $this->turnoverPerBrandWithSales($dateRange);

        $tpbAll = [];

        try {
            $allBrands = (new BrandRepository())->getAllBrands();
        } catch (Exception $e) {
            throw new SalesException('A database operation failed');
        }

        foreach ($allBrands as $brand) {

            $dates = [];
            $total = 0;
            foreach ($dateRange as $date) {

                $val = 0;
                foreach ($sales as $sale) {

                    if ($brand['id'] == $sale['id'] && $date == $sale['date'])
                        $val = $sale['turnover'];
                }

                $date = [
                    'date' => $date,
                    'turnover' => $val
                ];
                $total = $total + $val;
                array_push($dates, $date);
            }
            $row = [
                'id' => $brand['id'],
                'name' => $brand['name'],
                'turnover' => $dates,
                'total' => $total,
                'total_without_vat' => $this->withoutVat($total)
            ];

            array_push($tpbAll, $row);
        }

        return $tpbAll;
    }


    public function turnoverPerDay(array $dateRange)
    {
        $sales = $this->turnoverPerDayWithSales($dateRange);

        $tpdAll = [];

        foreach ($dateRange as $date) {
            $turnover = 0;
            foreach ($sales as $sale) {

                if ($date == $sale['date'])
                    $turnover = $sale['turnover'];
            }
            $row = [
                'date' => $date,
                'turnover' => $turnover,
                'total_without_vat' => $this->withoutVat($turnover)
            ];
            array_push($tpdAll, $row);
        }

        return $tpdAll;
    }


    private function turnoverPerBrandWithSales(array $dateRange)
    {
        try {
            return (new SalesRepository())->getTrunOverPerBrand($dateRange);
        } catch (Exception $e) {
            throw new SalesException('A database operation failed');
        }
    }

    private function turnoverPerDayWithSales(array $dateRange)
    {
        try {
            return (new SalesRepository())->getTrunOverPerDay($dateRange);
        } catch (Exception $e) {
            throw new SalesException('A database operation failed');
        }
    }

    private function withoutVat($price)
    {
        return $price * (100 - Vat::getVat()) / 100;
    }
}
