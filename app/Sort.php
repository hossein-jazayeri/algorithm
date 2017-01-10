<?php

namespace App;

class Sort
{
    public function quickSort(array $input)
    {
        if (count($input) < 2) {
            return $input;
        }
        $left = $right = [];
        reset($input);
        $pivot_key = key($input);
        $pivot     = array_shift($input);
        foreach ($input as $key => $value) {
            if ($value < $pivot) {
                $left[$key] = $value;
            } else {
                $right[$key] = $value;
            }
        }
        return array_merge($this->quickSort($left), [$pivot_key => $pivot], $this->quickSort($right));
    }

    public function selectionSort(array $input)
    {
        $count = count($input);
        for ($i = 0; $i < $count; $i++) {
            $biggest_index = 0;
            $biggest       = $input[0];
            for ($j = 0; $j < $count - $i; $j++) {
                if ($input[$j] >= $biggest) {
                    $biggest       = $input[$j];
                    $biggest_index = $j;
                }
            }
            $last_input             = $input[$count - $i - 1];
            $input[$count - $i - 1] = $biggest;
            $input[$biggest_index]  = $last_input;
        }
        return $input;
    }

    public function bubbleSort(array $input)
    {
        $count = count($input);
        for ($i = 0; $i < $count; $i++) {
            for ($j = 0; $j < $count - $i; $j++) {
                if (isset($input[$j + 1]) && $input[$j] > $input[$j + 1]) {
                    $temp          = $input[$j + 1];
                    $input[$j + 1] = $input[$j];
                    $input[$j]     = $temp;
                }
            }
        }
        return $input;
    }

    public function mergeSort(array $input, $from, $to)
    {
        if ($from + $to <= 2 || $from == $to) {
            return $input;
        }

        $mid = floor(($from + $to) / 2);
        $this->mergeSort($input, $from, $mid);
        $this->mergeSort($input, $mid + 1, $to);
        return $this->merge($input, $from, $mid, $to);
    }

    private function merge(array $input, $from, $mid, $to)
    {
        $j = $from;
        for ($i = $mid + 1; $i <= $to; $i++) {
            while ($input[$j] <= $input[$i] && $j < $i) {
                $j++;
            }
            if ($i == $j) {
                break;
            }
            $temp = $input[$i];
            for ($k = $i; $k > $j; $k--) {
                $input[$k] = $input[$k - 1];
            }
            $input[$j] = $temp;
        }
        return $input;
    }
}
