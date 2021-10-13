<?php declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/LogDecorator.php';
require_once __DIR__.'/src/Log.php';
require_once __DIR__.'/src/Exceptions/InvalidInputFileException.php';

$filename = $argv[1] ?? null;
$pattern = '/test\.(\w+)/';
$filters = array('debug');

try {
    $log = new Log($filename);
    $decorator = new LogDecorator($pattern);
    $decorator->addFilter($filters);
    $decorator->run($log);
} catch (InvalidInputFileException $e) {
    exit($e->getMessage() . PHP_EOL);
}
