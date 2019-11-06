<?php

namespace SimpleMathWorksheetGenerator\Calculations;

/**
 * Class represents a subtraction.
 */
class Subtraction implements Calculation
{
    public $minuend;
    public $operator = '-';
    public $subtrahend;
    public $difference;

    public function __construct(int $minuend, int $subtrahend) {
        $this->minuend = $minuend;
        $this->subtrahend = $subtrahend;
        $this->difference = $this->minuend - $this->subtrahend;
    }

    public function getRenderOutput() {
        return [
            'part1' => $this->minuend,
            'operator' => $this->operator,
            'part2' => $this->subtrahend,
            'result' => $this->difference
        ];
    }
}