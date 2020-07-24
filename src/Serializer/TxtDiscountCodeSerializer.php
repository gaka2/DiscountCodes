<?php

namespace App\Serializer;

use App\Model\DiscountCode;

/**
 * @author Karol Gancarczyk
 */
class TxtDiscountCodeSerializer implements DiscountCodeSerializerInterface {

    private const END_OF_LINE = "\n";

    public function serializeObjects(array $discountCodes) {
        return implode(self::END_OF_LINE, 
            array_map(function ($discountCode) {
                return $this->serialize($discountCode);
            }, $discountCodes)
        );
    }

    public function serialize(DiscountCode $discountCode) {
        return $discountCode->getValue();
    }
}