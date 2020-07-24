<?php

namespace App\Service\Generator;

/**
 * @author Karol Gancarczyk
 */
abstract class AbstractDiscountCodesGenerator {

    protected $alphabet;

    public function __construct(AbstractAlphabet $alphabet) {
        $this->alphabet = $alphabet;
    }

    abstract public function generateUniqueCodes(int $numberOfCodes, int $lengthOfCode): array;
}