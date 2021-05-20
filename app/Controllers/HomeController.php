<?php

namespace App\Controllers;


use App\Libs\DateGenerator;
use App\Exception\SalesException;
use App\Libs\CsvGenerator;
use App\Reports\Formatter\TurnoverPerBrand;
use App\Reports\Formatter\TurnoverPerDay;

use App\Job\CsvGeneratHandler;
use App\Libs\ReqValidator;

class HomeController extends Controller
{
    public function index()
    {
        return $this->response->render('home.index');
    }

    public function download()
    {
        $data = $this->request->get;



        try {

            (new ReqValidator)->formData($data);
            $dateRange = DateGenerator::between($data['startdate'], $data['enddate']);

            $fileLink = false;
            $fileName = "";

            switch ($data['download_action']) {
                case 'tpb':
                    $fileName = "total-turnover-per-brand.csv";
                    $fileLink = CsvGenerator::csv((new TurnoverPerBrand($dateRange)), $fileName);
                    break;
                case 'tpd':
                    $fileName = "total-turnover-per-day.csv";
                    $fileLink = CsvGenerator::csv((new TurnoverPerDay($dateRange)), $fileName);
                    break;
                case 'tpb_job':
                    $fileName = "total-turnover-per-brand.csv";
                    //(new CsvGeneratHandler)->handle('df');
                    break;
            }

            if ($fileLink)
                return $this->response->render('home.download',  compact('fileName'));
        } catch (SalesException $error) {
            $error_message = $error->getMessage();
            return $this->response->render('error.error', compact('error_message'));
        }
    }
}
