<?php

declare(strict_types=1);

namespace App\Document;

use Ramsey\Uuid\Uuid;
use App\Exceptions\NotFoundException;
use App\Document\ValueObjects\StatusVO;
use App\Document\Exceptions\DocumentStoreException;
use App\Document\Exceptions\DocumentServiceException;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

class DocumentService
{

    /**
     * @var DocumentFactory
     */
    private $factory;

    /** @var DocumentStoreInterface */
    private $store;

    /**
     * @param DocumentFactory $factory
     * @param DocumentStoreInterface $store
     */
    public function __construct(
        DocumentFactory $factory,
        DocumentStoreInterface $store
    ) {
        $this->factory = $factory;
        $this->store = $store;
    }

    public function create()
    {
        $document = $this->factory->createDraft();
        $this->store->save($document);
        return $document;
    }

    public function find()
    {
        return $this->store->find(100, 0);
    }

    /**
     * @param string $id
     * @return DocumentEntity
     * @throws DocumentServiceException
     * @throws NotFoundException
     */
    public function findOne(string $id): DocumentEntity
    {
        try {
            $document = $this->store->findByID(Uuid::fromString($id));
        } catch (InvalidUuidStringException $e) {
            throw new DocumentServiceException(
                $e->getMessage(),
                400,
                $e
            );
        } catch (DocumentStoreException | NotFoundException $e) {
            throw new DocumentServiceException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }

        return $document;
    }

    /**
     * @param string $id
     * @return DocumentEntity
     * @throws DocumentServiceException
     * @throws NotFoundException
     */
    public function publish(string $id): DocumentEntity
    {
        try {
            $document = $this->store->findByID(Uuid::fromString($id));
            $document->setStatus(new StatusVO(StatusVO::PUBLISHED));

            $this->store->save($document);

            return $document;
        } catch (InvalidUuidStringException $e) {
            throw new DocumentServiceException(
                $e->getMessage(),
                400,
                $e
            );
        } catch (DocumentStoreException | NotFoundException $e) {
            throw new DocumentServiceException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
