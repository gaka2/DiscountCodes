<?php

namespace App\Service\FileSaver;

/**
 * @author Karol Gancarczyk
 */
interface FileSaverInterface {
    public function saveDiscountCodes(array $discountCodes, string $fileName): void;
}
