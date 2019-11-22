<?php

namespace RechnenWebzeugNet;

class Utility {

    public static function addSpaceForSingleDigit(int $number) {
        if ($number < 10) {
            return "<span style='opacity:0;'>0</span>" . $number;
        } else {
            return $number;
        }
    }

    public static function calculateWidthOfInput(int $number): int {
        $width = 80;
        $singleWidth = 20;
        $padding = 10;

        if ($number !== 0) {
            $digits = floor(log10($number) + 1);
            $calcWidth = 2 * $padding + $digits * $singleWidth;
            if ($calcWidth > $width) {
                $width = $calcWidth;
            }
        }

        return $width;
    }
}