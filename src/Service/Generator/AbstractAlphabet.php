<?php

namespace App\Service\Generator;

/**
 * @author Karol Gancarczyk
 */
abstract class AbstractAlphabet {
    abstract public function getSize(): int;
    abstract public function getRandomUniqueLetters(int $numberOfLetters): array;
    abstract public function getRandomLetters(int $numberOfLetters): array;
}