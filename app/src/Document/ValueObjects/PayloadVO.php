<?php

declare(strict_types=1);

namespace App\Document\ValueObjects;

use JsonSerializable;
use InvalidArgumentException;

class PayloadVO implements JsonSerializable
{

    /**
     * @var array
     */
    private $payload;

    /**
     * @param array $payload
     * @throws InvalidArgumentException
     */
    public function __construct(array $payload = [])
    {
        if (json_encode($payload) && json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException(
                sprintf('Json is not valid. Error: %s', json_last_error())
            );
        }

        $this->payload = $payload;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->payload;
    }
}
