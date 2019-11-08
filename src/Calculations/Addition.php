<?php

namespace RechnenWebzeugNet\Calculations;

use RechnenWebzeugNet\Calculations\Subtraction;

/**
 * Class represents an addition.
 */
class Addition implements Calculation
{
     public $summand1;
     public $operator = '+';
     public $summand2;
     public $sum;

     public function __construct(int $summand1, int $summand2) {
        $this->summand1 = $summand1;
        $this->summand2 = $summand2;
        $this->sum = $this->summand1 + $this->summand2;
     }

     public function getSubtraction(): Subtraction {
         return new Subtraction($this->sum, $this->summand1);
     }

     public function getRenderOutput() {
        return [
            'part1' => $this->summand1,
            'operator' => $this->operator,
            'part2' => $this->summand2,
            'result' => $this->sum
        ];
     }

     public static function createRandomAddition(int $minResult, int $maxResult) {
        $result = 0;
        $summand1 = rand(0, ($maxResult-1));
        while ($result > $maxResult | $result == 0 | $result < $minResult) {
            $summand2 = rand(1, ($maxResult - $summand1));
            $result = $summand1 + $summand2;
        }
        return new Addition($summand1, $summand2);
     }
}