<?php

namespace RechnenWebzeugNet;

class Utility {

    public static function randomNumbersSum($num_numbers = 3, $total = 500) {
        $numbers = [];
        $loose_pcc = $total / $num_numbers;

        for($i = 1; $i < $num_numbers; $i++) {
            // Random number +/- 10%
            $ten_pcc = $loose_pcc * 0.1;
            $rand_num = mt_rand( ($loose_pcc - $ten_pcc), ($loose_pcc + $ten_pcc) );

            $numbers[] = $rand_num;
        }

        // $numbers now contains 1 less number than it should do, sum 
        // all the numbers and use the difference as final number.
        $numbers_total = array_sum($numbers);

        $numbers[] = $total - $numbers_total;

        return $numbers;
    }
}