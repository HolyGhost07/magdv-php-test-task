<?php

declare(strict_types=1);

namespace App\Document\Doctrine\DBAL\Types;

use InvalidArgumentException;
use Doctrine\DBAL\Types\StringType;
use App\Document\ValueObjects\StatusVO;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class DocumentStatusType extends StringType
{
    /**
     * @var string
     */
    public const NAME = 'document_status';

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        try {
            return new StatusVO((string)$value);
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
