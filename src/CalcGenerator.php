<?php

namespace RechnenWebzeugNet;

use RechnenWebzeugNet\Calculations\Addition;
use RechnenWebzeugNet\Calculations\Subtraction;
use RechnenWebzeugNet\Calculations\Multiplication;
use RechnenWebzeugNet\Calculations\Division;

/**
 * Calculation generator
 * 
 * Generates multiple calculations with the given parameters.
 */
class CalcGenerator {

    public function generateAdditions(int $amount, int $minResult, int $maxResult): array {
        $additions = [];
        for ($i = 0; $i < $amount; $i++) {
            $additions[] = Addition::createRandomAddition($minResult, $maxResult);
        }
        return $additions;
    }

    public function generateSubtractions(int $amount, int $minResult, int $maxResult): array {
        $additions = $this->generateAdditions($amount, $minResult, $maxResult);
        $subtractions = [];
        for ($i = 0; $i < $amount; $i++) {
            $subtractions[] = $additions[$i]->getSubtraction();
        }
        return $subtractions;
    }

    public function generateMultiplications(int $amount, int $factor1, int $factor2): array {
        $multiplications = [];
        for ($i = 0; $i < $amount; $i++) {
            $multiplications[] = Multiplication::createRandomMultiplication($factor1, $factor2);
        }
        return $multiplications;
    }

    public function generateDivisions(int $amount, int $factor1, int $factor2): array {
        $multiplications = $this->generateMultiplications($amount, $factor1, $factor2);
        $divisions = [];
        for ($i = 0; $i < $amount; $i++) {
            $divisions[] = $multiplications[$i]->getDivision();
        }
        return $divisions;
    }

    public function generateMixedEqual(int $amount, int $minResult, int $maxResult, int $factor1, int $factor2) {
        $eachAmount = intdiv($amount, 4);
        $rest = $amount % $eachAmount;
        $calculations = [];
        $calculations = array_merge($calculations, $this->generateAdditions($eachAmount, $minResult, $maxResult));
        $calculations = array_merge($calculations, $this->generateSubtractions($eachAmount, $minResult, $maxResult));
        $calculations = array_merge($calculations, $this->generateMultiplications($eachAmount, $factor1, $factor2));
        $calculations = array_merge($calculations, $this->generateDivisions($eachAmount + $rest, $factor1, $factor2));
        shuffle($calculations);
        return $calculations;
    }

    public function generateMixedUnequal(int $amount, int $minResult, int $maxResult, int $factor2, int $factor1) {
        
    }
}