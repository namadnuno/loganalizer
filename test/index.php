<?php

require __DIR__ . '/vendor/autoload.php';

echo "hello";

use Monolog\Logger;
use Loganalizer\LoganalizerHandler;

$config = require(__DIR__ . '/config/loganalizer.php');

$loganalizer = new LoganalizerHandler($config['api_url'], $config['api_key']);

// Create the main logger of the app
$logger = new Logger('my_logger');
$logger->pushHandler($loganalizer);

$logger->addRecord(400, 'teste');
