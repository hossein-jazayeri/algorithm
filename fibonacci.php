<?php

function fibonacciRecursive($n)
{
    if ($n == 1 || $n == 2) {
        return 1;
    }

    return fibonacciRecursive($n - 1) + fibonacciRecursive($n - 2);
}

function fibonacciRecursiveImproved($iterationsLeft, $prePrevious = 0, $previous = 1)
{
    if ($iterationsLeft == 0) {
        return $previous;
    }
    return fibonacciRecursiveImproved($iterationsLeft - 1, $previous, bcadd($prePrevious, $previous));
}

function fibonacciNoRecursionWithArray($n)
{
    $r = [];
    $r[0] = 1;
    $r[1] = 1;
    $i = 2;
    while ($i != $n) {
        $r[$i] = bcadd($r[$i - 1], $r[$i - 2]);
        $i++;
    }
    return $r[$n - 1];
}

function fibonacciNoRecursionWithArrayImproved($n)
{
    $r0 = 1;
    $r1 = 1;
    $r2 = 1;
    $i = 2;
    while ($i != $n) {
        $r2 = bcadd($r0, $r1);
        $r0 = $r1;
        $r1 = $r2;
        $i++;
    }
    return $r2;
}

function fibonacciCallback($n)
{
    return trampoline(
        function () use ($n) {
            return fibonacciInternal($n, 0, 1);
        }
    );
}

function trampoline($function)
{
    $result = function () use ($function) {
        return $function();
    };
    while (is_callable($result)) {
        $result = $result();
    }
    return $result;
}

function fibonacciInternal($iterationsLeft, $prePrevious = 0, $previous = 1)
{
    if ($iterationsLeft == 0) {
        return $prePrevious;
    }
    return function () use ($iterationsLeft, $prePrevious, $previous) {
        return fibonacciInternal($iterationsLeft - 1, $previous, bcadd($prePrevious, $previous));
    };
}

$start = microtime(true);
fibonacciRecursive(40);
echo echoPerformance("fibonacciRecursive(40)", $start);

$start = microtime(true);
fibonacciRecursiveImproved(21500);
echo echoPerformance("fibonacciRecursiveImproved(21,500)", $start);

$start = microtime(true);
fibonacciNoRecursionWithArray(200000);
echo echoPerformance("fibonacciNoRecursionWithArray(200,000)", $start);

$start = microtime(true);
fibonacciNoRecursionWithArrayImproved(200000);
echo echoPerformance("fibonacciNoRecursionWithArrayImproved(200,000)", $start);

$start = microtime(true);
fibonacciCallback(200000);
echo echoPerformance("fibonacciCallback(200,000)", $start);

function echoPerformance($what, $start)
{
    return sprintf('"%s" took %ss', $what, number_format(microtime(true) - $start, 4)) . PHP_EOL;
}
