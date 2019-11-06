<?php

namespace SimpleMathWorksheetGenerator;

class Calc {

    public $randGenerator;
    public $type;
    public $part1;
    public $part2;
    public $result = 0;
    public $operand;

    public function __construct($randGenerator, string $type, int $addMin, int $addMax) {
        $this->randGenerator = $randGenerator;
        $this->type = $type;

        switch ($type) {
            case 'addition':
                $this->operand = "+";
                $this->part1 = $this->randGenerator->generateInt($addMin, $addMax);
                while ($this->result > 100 || $this->result == 0) {
                    $this->part2 = $this->randGenerator->generateInt(0, ($addMax - $this->part1));
                    $this->result = $this->part1 + $this->part2;
                }
                break;
            default:
                break;
        }

        
    }

}