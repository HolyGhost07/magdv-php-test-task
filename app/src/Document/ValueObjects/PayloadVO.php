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
                sprintf('Json isn\'t not valid. Error: %s', json_last_error()),
                400
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
