<?php

namespace App\Controllers;


use App\Libs\DateGenerator;
use App\Exception\SalesException;
use App\Libs\CsvGenerator;
use App\Reports\Generater\Csv\Turnoverperbrand;
use App\Reports\Generater\Csv\Turnoverperday;


class HomeController extends Controller
{
    public function index()
    {
        return $this->response->render('home.index');
    }

    public function download()
    {
        $data = $this->request->get;

        /**
         * Validation date
         * date max min
         * action type
         */

        try {

            $dateRange = DateGenerator::between($data['startdate'], $data['enddate']);
            $fileLink = "";
            switch ($data['download_action']) {
                case 'tpb':
                    $fileLink = CsvGenerator::csv((new Turnoverperbrand($dateRange)));
                    break;
                case 'tpd':
                    $fileLink = CsvGenerator::csv((new Turnoverperday($dateRange)));
                    break;
                case 2:
                    echo "i equals 2";
                    break;
            }
       
            if($fileLink)
                return $this->response->render('home.download',  compact('fileLink'));

        } catch (SalesException $error) {
            $error_message = $error->getMessage();
            return $this->response->render('error.error', compact('error_message'));
        }
    }
}
