<?php

namespace App\Service;

use App\Service\Generator\AbstractDiscountCodesGenerator;

/**
 * @author Karol Gancarczyk
 */
class DiscountCodesService {

    private $discountCodesGenerator;

    public function __construct(AbstractDiscountCodesGenerator $discountCodesGenerator) {
        $this->discountCodesGenerator = $discountCodesGenerator;
    }

    public function generateDiscountCodes(int $numberOfCodes, int $lengthOfCode): array {
        return $this->discountCodesGenerator->generateUniqueCodes($numberOfCodes, $lengthOfCode);
    }
}