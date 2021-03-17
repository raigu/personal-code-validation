<?php declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\CodeCoverage;

$filter = new Filter;
$filter->includeDirectory($argv[2]);

$coverage = new CodeCoverage(
    (new Selector)->forLineCoverage($filter),
    $filter
);

$coverage->start('raigu/personal-code-validation');

include_once $argv[1];


$coverage->stop();
(new \SebastianBergmann\CodeCoverage\Report\Clover)->process($coverage, $argv[3]);
