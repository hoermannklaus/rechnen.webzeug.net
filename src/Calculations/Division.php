<?php

namespace SimpleMathWorksheetGenerator\Calculations;

/**
 * Represents a division
 */
class Division implements Calculation
{
    public $dividend;
    public $operator = ":";
    public $divisor;
    public $quotient;

    public function __construct(int $dividend, int $divisor) {
        $this->dividend = $dividend;
        $this->divisor = $divisor;
        $this->quotient = $this->dividend / $this->divisor;
    }

    public function getRenderOutput() {
        return [
            'part1' => $this->dividend,
            'operator' => $this->operator,
            'part2' => $this->divisor,
            'result' => $this->quotient
        ];
    }
}