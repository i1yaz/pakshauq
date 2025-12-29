<?php
use Ilyas\DBFactory;
use Ilyas\Driver\RedisDB;
use Ilyas\VisitorsCounter;

require __DIR__ . '/../vendor/autoload.php';

$dbFactory = new DBFactory();
$dbFactory->setDriver(RedisDB::class);
$dataBase = $dbFactory->makeDB(['127.0.0.1', '', '', '']);
$repository = $dbFactory->getRepository($dataBase,'sadullahpur_visitors');
echo VisitorsCounter::getCount($repository, 60*5);
