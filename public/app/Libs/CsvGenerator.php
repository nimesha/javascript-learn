<?php

namespace App\Libs;

use App\Reports\Generater\CsvReportInterface;
use League\Csv\CannotInsertRecord;
use League\Csv\Writer;

class CsvGenerator
{
    public static function csv(CsvReportInterface $rep)
    {
        $rep = $rep->export();

        try {
            $writer = Writer::createFromPath(ROOT . 'download_csv/' . $rep['file_name'], 'w+');
            $writer->insertOne($rep['header']);
            foreach ($rep['body'] as $item) {
                $writer->insertOne($item);
            }

            return $rep['file_name'];
        } catch (CannotInsertRecord $e) {
            //Error log
        }
    }
}
