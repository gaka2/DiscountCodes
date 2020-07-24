<?php

namespace App\Service\Generator;

use App\Service\Generator\AbstractDiscountCodesGenerator;
use App\Model\DiscountCode;

/**
 * @author Karol Gancarczyk
 */
class DiscountCodesGenerator extends AbstractDiscountCodesGenerator {

    public function generateUniqueCodes(int $numberOfCodes, int $lengthOfCode): array {

        if ($numberOfCodes <= 0) {
            throw new \InvalidArgumentException("Number of codes shuold be positive. Passed: {$numberOfCodes}");
        }

        if ($lengthOfCode <= 0) {
            throw new \InvalidArgumentException("Length of codes shuold be positive. Passed: {$lengthOfCode}");
        }

        $alphabetSize = $this->alphabet->getSize();
        $maximumNumberOfUniqueCodes = pow($alphabetSize, $lengthOfCode);
        if ($numberOfCodes > $maximumNumberOfUniqueCodes) {
            throw new \InvalidArgumentException("Alphabet with {$alphabetSize} symbols can create at most {$maximumNumberOfUniqueCodes} unique codes with length {$lengthOfCode} while requested {$numberOfCodes} unique codes.");
        }

        return array_map(function ($code) {
                return new DiscountCode($code);
            }, $this->generateUniqueCodesHelper($numberOfCodes, $lengthOfCode, ['']));
    }

    private function generateUniqueCodesHelper(int $numberOfCodes, int $lengthOfCode, array $accumulatedResult): array {

        if ($lengthOfCode === 0) {
            return $accumulatedResult;
        }

        if (count($accumulatedResult) >= $numberOfCodes) {
            $missingLetters = implode('', $this->alphabet->getRandomLetters($lengthOfCode));

            for ($i = 0; $i < count($accumulatedResult); $i++) {
                $accumulatedResult[$i] .= $missingLetters;
            }
            return $accumulatedResult;
        }

        $numberOfUniqeCodesCreatedUntilNow = count($accumulatedResult);
        $numberOfNeededLetters = (int) ceil($numberOfCodes / $numberOfUniqeCodesCreatedUntilNow);

        $newAccumulatedResult = [];
        $resultCount = 0;
        $letters = $this->alphabet->getRandomUniqueLetters(min([$this->alphabet->getSize(), $numberOfNeededLetters]));

        foreach ($letters as $letter) {
            foreach ($accumulatedResult as $code) {
                $newAccumulatedResult[] = $letter . $code;
                $resultCount++;
                if ($resultCount >= $numberOfCodes) {
                    break 2;
                }
            }
        }

        return $this->generateUniqueCodesHelper($numberOfCodes, $lengthOfCode - 1, $newAccumulatedResult);
    }
}