<?php

namespace SimpleMathWorksheetGenerator\Calculations;

use SimpleMathWorksheetGenerator\Calculations\Division;

/**
 * Class represents a multiplication.
 */
class Multiplication implements Calculation
{
    public $multiplier;
    public $operator = '*';
    public $multiplicand;
    public $product;

    public function __construct(int $multiplier, int $multiplicand) {
        $this->multiplier = $multiplier;
        $this->multiplicand = $multiplicand;
        $this->product = $this->multiplier * $this->multiplicand;
    }

    public function getDivision(): Division {
        return new Division($this->product, $this->multiplier);
    }

    public function getRenderOutput() {
        return [
            'part1' => $this->multiplier,
            'operator' => $this->operator,
            'part2' => $this->multiplicand,
            'result' => $this->product
        ];
    }

    public static function createRandomMultiplication(int $factor1, int $factor2) {
        $result = 0;
        $multiplier = rand($factor1, $factor2);
        $multiplicand = rand($factor1, $factor2);
        return new Multiplication($multiplier, $multiplicand);
    }
}