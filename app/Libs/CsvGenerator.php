<?php

namespace App\Libs;

use App\Reports\Formatter\FormatterReportInterface;
use League\Csv\CannotInsertRecord;
use League\Csv\Writer;

class CsvGenerator
{
    /**
     * 
     * @param  report, filename
     * @return true
     * @throws \Exception
     */
    public static function csv(FormatterReportInterface $rep, $fileName)
    {
        $rep = $rep->export();

        try {

            $writer = Writer::createFromPath(ROOT . 'public/download_csv/' . $fileName, 'w+');
            $writer->insertOne($rep['header']);
            foreach ($rep['body'] as $item) {
                $writer->insertOne($item);
            }

            return true;
        } catch (CannotInsertRecord $e) {
            // log to bug tacker
        }
    }
}
