<?php

namespace App\Job;

use Redis;
use Tomaj\Hermes\Driver\RedisSetDriver;
use Tomaj\Hermes\Dispatcher;
use Tomaj\Hermes\Handler\HandlerInterface;
use App\Libs\CsvGenerator;
use App\Reports\Formater\TurnoverPerBrand;

class CsvGeneratHandler implements HandlerInterface
{


    public function handle(MessageInterface $message)
    {
        //     CsvGenerator::csv((new TurnoverPerBrand($dateRange)), $fileName);
        //     return true;
    }
}


// create dispatcher like in the first snippet
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$driver = new RedisSetDriver($redis);
$dispatcher = new Dispatcher($driver);

// register handler for event
$dispatcher->registerHandler('make-csv', new CsvGeneratHandler());

// at this point this script will wait for new message
$dispatcher->handle();
