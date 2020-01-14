<?php

declare(strict_types=1);

namespace App\Document;

use DateTime;
use JsonSerializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use App\Document\ValueObjects\StatusVO;
use App\Document\ValueObjects\PayloadVO;

/**
 * @Entity
 * @Table(name="documents")
 **/
class DocumentEntity implements JsonSerializable
{

    /**
     * @Id
     * @Column(name="id", type="uuid_binary_ordered_time")
     * @GeneratedValue(strategy="CUSTOM")
     * @CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidOrderedTimeGenerator")
     *
     * @var UuidInterface
     * */
    private $uuid;

    /**
     * @Column(name="status", type="document_status")
     *
     * @var StatusVO
     * */
    private $status;

    /**
     * @Column(name="payload", type="document_payload")
     *
     * @var PayloadVO
     */
    private $payload;

    /**
     * @Column(name="created_at", type="datetime")
     *
     * @var DateTime
     */
    private $createdAt;

    /**
     * @Column(name="updated_at", type="datetime")
     *
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @param StatusVO $status
     * @param PayloadVO $payload
     */
    public function __construct(StatusVO $status, PayloadVO $payload)
    {
        $this->status = $status;
        $this->payload = $payload;
        
        $time = (new DateTime());
        $this->createdAt = $time;
        $this->updatedAt = $time;
    }

    /**
     * @return UuidInterface|null
     */
    public function getID(): ?UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @param StatusVO $status
     * @return self
     */
    public function setStatus(StatusVO $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return StatusVO
     */
    public function getStatus(): StatusVO
    {
        return $this->status;
    }

    /**
     * @return PayloadVO
     */
    public function getPayload(): PayloadVO
    {
        return $this->payload;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->uuid->toString(),
            'status' => (string)$this->status,
            'payload' => $this->payload,
            'createdAt' => $this->createdAt->format(DateTime::ISO8601),
            'updatedAt' => $this->updatedAt->format(DateTime::ISO8601),
        ];
    }
}
