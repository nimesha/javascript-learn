<?php

use Redis;
use Tomaj\Hermes\Driver\RedisSetDriver;
use Tomaj\Hermes\Dispatcher;


class Driver
{

    public function CsvGenerat()
    {
        // create dispatcher like in the first snippet
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $driver = new RedisSetDriver($redis);
        $dispatcher = new Dispatcher($driver);

        // register handler for event
        $dispatcher->registerHandler('make-csv', new CsvGeneratHandler());

        // at this point this script will wait for new message
        $dispatcher->handle();
    }
}
