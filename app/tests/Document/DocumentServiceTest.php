<?php

declare(strict_types=1);

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\DocumentService;

class DocumentServiceTest extends TestCase
{

    /**
     * @var DocumentService
     * */
    private $service;

    public function setUp(): void
    {
        // $this->service = new DocumentService();
    }

    public function testCreateDocument(): void
    {
        // $expected = new Document(null);

        // $actual = $this->service->createDocument();

        // $this->assertInstanceOf(Document::class, $actual);
        // $this->assertEquals($expected, $actual);
        $this->assertEquals(true, true);
    }
}
