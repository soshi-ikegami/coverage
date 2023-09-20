<?php

use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\RawCodeCoverageData;
use SebastianBergmann\CodeCoverage\Report\Html\Facade;
use SebastianBergmann\CodeCoverage\CodeCoverage;

require_once 'vendor/autoload.php';

$coverages = glob('/data/coverage/coverage-*.json');

$filter = new Filter();
$filter->includeDirectory("/path/to/your/project/src");

$finalCoverage = new CodeCoverage(
    (new Selector)->forLineCoverage($filter),
    $filter
);

$count = count($coverages);
foreach ($coverages as $index => $coverageFile) {
    echo 'Processing coverage (' . (string)($index + 1) . "/$count) from $coverageFile". PHP_EOL;
    $rawData = json_decode(file_get_contents($coverageFile), true);
    $coverageData = RawCodeCoverageData::fromXdebugWithoutPathCoverage($rawData);
    $testName = str_ireplace(basename($coverageFile, ".json"), "coverage-", "");
    $finalCoverage->append($coverageData, $testName);
}

echo "Generating final report..." . PHP_EOL;
$report = new Facade();
$report->process($finalCoverage, 'reports');
echo "Report generated succesfully". PHP_EOL;
