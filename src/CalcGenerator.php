<?php

namespace SimpleMathWorksheetGenerator;

use SimpleMathWorksheetGenerator\Calculations\Addition;
use SimpleMathWorksheetGenerator\Calculations\Subtraction;
use SimpleMathWorksheetGenerator\Calculations\Multiplication;
use SimpleMathWorksheetGenerator\Calculations\Division;

/**
 * Calculation generator
 * 
 * Generates multiple calculations with the given parameters.
 */
class CalcGenerator {

    /**
     * The amount of calculations to generate.
     */
    protected $amount;

    /**
     * Constructor for new CalculationGenerator objects.
     * It creates a new random number generator.
     * 
     * @param int $amount The amount of calculations to generate
     * @return void
     */
    public function __construct(int $amount) {
        $this->amount = $amount;
    }

    /**
     * Generate additions
     * 
     * @param int $minResult The minimum possible result.
     * @param int $maxResult The maximum possible result.
     * @return array Holding all the additions.
     */
    public function generateAdditions(int $minResult, int $maxResult): array {
        $additions = [];
        for ($i = 0; $i < $this->amount; $i++) {
            $additions[] = Addition::createRandomAddition($minResult, $maxResult);
        }
        return $additions;
    }

    /**
     * Generate subtractions with the help of generated additions
     * 
     * @param int $minResult The minimum result of the addition.
     * @param int $maxResult The maximum result of the addition.
     * @return array Holding all the subtractions.
     */
    public function generateSubtractions(int $minResult, int $maxResult): array {
        $additions = $this->generateAdditions($minResult, $maxResult);
        $subtractions = [];
        for ($i = 0; $i < $this->amount; $i++) {
            $subtractions[] = $additions[$i]->getSubtraction();
        }
        return $subtractions;
    }

    public function generateMultiplications(int $factor1, int $factor2): array {
        $multiplications = [];
        for ($i = 0; $i < $this->amount; $i++) {
            $multiplications[] = Multiplication::createRandomMultiplication($factor1, $factor2);
        }
        return $multiplications;
    }

    public function generateDivisions(int $factor1, int $factor2): array {
        $multiplications = $this->generateMultiplications($factor1, $factor2);
        $divisions = [];
        for ($i = 0; $i < $this->amount; $i++) {
            $divisions[] = $multiplications[$i]->getDivision();
        }
        return $divisions;
    }
}