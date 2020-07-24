<?php

namespace App\Serializer;

use App\Model\DiscountCode;

/**
 * @author Karol Gancarczyk
 */
interface DiscountCodeSerializerInterface {

    public function serializeObjects(array $discountCodes);

    public function serialize(DiscountCode $discountCode);
}