<?php

declare(strict_types=1);

namespace App\Document\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\JsonArrayType;
use App\Document\ValueObjects\PayloadVO;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class DocumentPayloadType extends JsonArrayType
{
    /**
     * @var string
     */
    public const NAME = 'document_payload';

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            $value = [];
        }

        try {
            return new PayloadVO(json_decode($value, true));
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed(
                $value,
                $this->getName()
            );
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return static::NAME;
    }
}
