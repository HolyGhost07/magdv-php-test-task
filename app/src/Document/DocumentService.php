<?php

declare(strict_types=1);

namespace App\Document;

use Ramsey\Uuid\Uuid;
use App\Exceptions\StoreException;
use App\Exceptions\ServiceException;
use App\Exceptions\NotFoundException;
use App\Document\ValueObjects\StatusVO;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

class DocumentService
{

    /**
     * @var DocumentFactory
     */
    private $factory;

    /**
     * @var DocumentStoreInterface
     * */
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

    public function create(): Document
    {
        $document = $this->factory->createDraft();

        $this->store->save($document);

        return $document;
    }

    public function find(): array
    {
        return $this->store->find(100, 0);
    }

    /**
     * @param string $id
     * @return Document
     * @throws ServiceException
     * @throws NotFoundException
     */
    public function findOne(string $id): Document
    {
        try {
            $document = $this->store->findByID(Uuid::fromString($id));
        } catch (InvalidUuidStringException $e) {
            throw new ServiceException(
                $e->getMessage(),
                400,
                $e
            );
        } catch (StoreException | NotFoundException $e) {
            throw new ServiceException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }

        return $document;
    }

    /**
     * @param string $id
     * @return Document
     * @throws ServiceException
     * @throws NotFoundException
     */
    public function publish(string $id): Document
    {
        try {
            $document = $this->store->findByID(Uuid::fromString($id));
            $document->setStatus(new StatusVO(StatusVO::PUBLISHED));

            $this->store->save($document);

            return $document;
        } catch (InvalidUuidStringException $e) {
            throw new ServiceException(
                $e->getMessage(),
                400,
                $e
            );
        } catch (StoreException | NotFoundException $e) {
            throw new ServiceException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
