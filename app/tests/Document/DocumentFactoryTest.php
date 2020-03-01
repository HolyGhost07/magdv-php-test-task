<?php

declare(strict_types=1);

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\DocumentFactory;
use App\Document\ValueObjects\StatusVO;
use App\Document\ValueObjects\PayloadVO;

class DocumentFactoryTest extends TestCase
{

    /**
     * @var DocumentFactory
     */
    private $factory;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->factory = new DocumentFactory();
    }

    /**
     * @return void
     */
    public function testCreateDraft(): void
    {
        $expectedStatus = new StatusVO(StatusVO::DRAFT);
        $expectedPayload = new PayloadVO();

        $document = $this->factory->createDraft();

        $this->assertEquals($expectedStatus, $document->getStatus());
        $this->assertEquals($expectedPayload, $document->getPayload());
    }
}
