<?php

namespace App\Service\FileSaver;

use Symfony\Component\Filesystem\Filesystem;
use App\Serializer\DiscountCodeSerializerInterface;

/**
 * @author Karol Gancarczyk
 */
class TextFileSaver implements FileSaverInterface {

    private $filesystem;
    private $discountCodeSerializer;

    public function __construct(Filesystem $filesystem, DiscountCodeSerializerInterface $discountCodeSerializer) {
        $this->filesystem = $filesystem;
        $this->discountCodeSerializer = $discountCodeSerializer;
    }

    public function saveDiscountCodes(array $discountCodes, string $fileName): void {
        $fileContent = $this->discountCodeSerializer->serializeObjects($discountCodes);
        $this->filesystem->dumpFile($fileName, $fileContent);
    }
}