<?php

declare(strict_types=1);

namespace App\Document;

use Ramsey\Uuid\UuidInterface;
use App\Document\Document;
use App\Exceptions\NotFoundException;
use App\Exceptions\StoreException;

interface DocumentStoreInterface
{

    /**
     * @param Document $entity
     * @return void
     * @throws StoreException
     */
    public function save(Document $entity): void;

    /**
     * @param UuidInterface $id
     * @return Document
     * @throws StoreException
     * @throws NotFoundException
     */
    public function findByID(UuidInterface $id): Document;

    /**
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    public function find(int $limit, int $offset): array;
}
