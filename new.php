<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__.'/src/DecoratorInterface.php';
require_once __DIR__.'/src/Decorator.php';
require_once __DIR__.'/src/FilterInterface.php';
require_once __DIR__.'/src/Filter.php';
require_once __DIR__.'/src/Log.php';
require_once __DIR__.'/src/LogModifier.php';
require_once __DIR__.'/src/Stats.php';
require_once __DIR__.'/src/Exceptions/InvalidInputFileException.php';

$filename = $argv[1] ?? null;
$pattern = '/test\.(\w+)/';
$filters = array('debug');

if(!isset($filename)) {
    exit("Missing log file" . PHP_EOL);
}
try {
    $log = new Log($filename);
    $filter = new Filter($filters);
    $decorator = new Decorator($pattern);
    $stats = new Stats();
    $logModifier = new LogModifier($decorator, $filter, $stats);
    $logModifier->run($log);
} catch (InvalidInputFileException $e) {
    exit($e->getMessage() . PHP_EOL);
}
