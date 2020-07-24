<?php

namespace App\Model;

/**
 * @author Karol Gancarczyk
 */
class DiscountCode {

    private $value;

    public function __construct(string $value) {
        $this->value = $value;
    }

    public function getValue(): string {
        return $this->value;
    }

    public function __toString() {
        return $this->value;
    }
}