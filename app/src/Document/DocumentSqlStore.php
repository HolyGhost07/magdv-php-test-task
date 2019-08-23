<?php

declare(strict_types=1);

namespace App\Document;

use Exception;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\EntityRepository;
use App\Exceptions\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use App\Document\Exceptions\DocumentStoreException;

class DocumentSqlStore implements DocumentStoreInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param DocumentEntity $entity
     * @return void
     * @throws DocumentStoreException
     */
    public function save(DocumentEntity $entity): void
    {
        try {
            $this->em->persist($entity);
            $this->em->flush();
        } catch (Exception $e) {
            $message = 'Can\'t save document.';
            if ($id = $entity->getID()) {
                $message = sprintf('%s ID: %s', $message, $id->toString());
            }

            throw new DocumentStoreException(
                $message,
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @param UuidInterface $id
     * @return DocumentEntity
     * @throws DocumentStoreException
     * @throws NotFoundException
     */
    public function findByID(UuidInterface $id): DocumentEntity
    {
        try {
            $entity = $this->em->find(DocumentEntity::class, $id);
        } catch (Exception $e) {
            throw new DocumentStoreException(
                sprintf('Can\'t find document. ID: %s', $id->toString()),
                500,
                $e
            );
        }

        if (is_null($entity)) {
            throw new NotFoundException(
                sprintf('Not found document. ID: %s', $id->toString())
            );
        }

        return $entity;
    }

    /**
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    public function find(int $limit, int $offset): array
    {
        return $this->repository->findAll();
    }
}
