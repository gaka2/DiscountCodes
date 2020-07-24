<?php

namespace App\Service\Generator;

/**
 * @author Karol Gancarczyk
 */
class LatinAlphabet extends AbstractAlphabet {

    private $letters = [];

    public function __construct() {
        $this->letters = LatinAplhabetBuilder::getSymbols();
    }

    public function getSize(): int {
        return count($this->letters);
    }

    public function getRandomUniqueLetters(int $numberOfLetters): array {
        $randomKeys = array_rand($this->letters, $numberOfLetters);
        return $this->getLettersByKeys($randomKeys);
    }

    public function getRandomLetters(int $numberOfLetters): array {
        $range = range(0, $numberOfLetters - 1);
        shuffle($range);
        $randomKeys = array_map(function ($key) {
            return $key % count($this->letters);
        }, $range);

        return $this->getLettersByKeys($randomKeys);    
    }

    private function getLettersByKeys(array $randomKeys) {
        if (!is_array($randomKeys)) {
            $value = $randomKeys;
            $randomKeys = [];
            $randomKeys[0] = $value;
        }

        shuffle($this->letters);

        return array_map(function($key) { return $this->letters[$key]; }, $randomKeys);
    }
}