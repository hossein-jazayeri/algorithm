<?php

namespace tests;

use App\Sort;

class SortTest extends TestCase
{
    public function testSort()
    {
        $input = [3, 0, 6, 1, 7, 2, 6, 5];
        $this->assertEquals([0, 1, 2, 3, 5, 6, 6, 7], (new Sort)->quickSort($input));

        $input = [7, 6, 6, 5, 3, 2, 1, 0];
        $this->assertEquals([0, 1, 2, 3, 5, 6, 6, 7], (new Sort)->quickSort($input));

        $this->assertEquals([0, 1, 2, 3, 5, 6, 6, 7], (new Sort)->selectionSort($input));

        $this->assertEquals([0, 1, 2, 3, 5, 6, 6, 7], (new Sort)->bubbleSort($input));

        $this->assertEquals([0, 1, 2, 3, 5, 6, 6, 7], (new Sort)->mergeSort($input, 0, count($input) - 1));
    }
}
