<?php

declare(strict_types=1);

namespace App\Document;

use Ramsey\Uuid\UuidInterface;
use App\Document\DocumentEntity;

interface DocumentStoreInterface
{

    /**
     * @param DocumentEntity $entity
     * @return void
     * @throws DocumentStoreException
     */
    public function save(DocumentEntity $entity): void;

    /**
     * @param UuidInterface $id
     * @return DocumentEntity
     * @throws DocumentStoreException
     * @throws NotFoundException
     */
    public function findByID(UuidInterface $id): DocumentEntity;

    /**
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    public function find(int $limit, int $offset): array;
}
