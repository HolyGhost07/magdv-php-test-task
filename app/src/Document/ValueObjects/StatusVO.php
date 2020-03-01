<?php

declare(strict_types=1);

namespace App\Document\ValueObjects;

use InvalidArgumentException;

class StatusVO
{

    /**
     * @var string
     */
    public const DRAFT = 'draft';

    /**
     * @var string
     */
    public const PUBLISHED = 'published';

    /**
     * @var string[]
     */
    public const STATUSES = [
        self::DRAFT,
        self::PUBLISHED,
    ];

    /**
     * @var string
     */
    private $status;

    /**
     * @param string $status
     */
    public function __construct(string $status)
    {
        $status = mb_strtolower($status);
        if (!in_array($status, self::STATUSES)) {
            $message = sprintf('%s is not valid status', $status);
            throw new InvalidArgumentException($message);
        }

        $this->status = $status;
    }

    /**
     * @param StatusVO $status
     * @return bool
     */
    public function equals(StatusVO $status): bool
    {
        return $this->status == (string)$status;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->status;
    }
}
