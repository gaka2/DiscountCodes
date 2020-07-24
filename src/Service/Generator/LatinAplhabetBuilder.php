<?php

namespace App\Service\Generator;

/**
 * @author Karol Gancarczyk
 */
class LatinAplhabetBuilder {
    public static function getSymbols(): array {
        return array_merge(
            self::getDigits(),
            self::getBigLetters(),
            self::getSmallLetters(),
        );
    }

    private static function getAsciiCharacters(string $from, string $to): array {
        $result = [];
        for ($i = ord($from); $i <= ord($to); $i++) {
            $result[] = chr($i);
        }
        return $result;
    }

    private static function getDigits(): array {
        return self::getAsciiCharacters('0', '9');
    }

    private static function getBigLetters(): array {
        return self::getAsciiCharacters('A', 'Z');
    }

    private static function getSmallLetters(): array {
        return self::getAsciiCharacters('a', 'z');
    }
}
