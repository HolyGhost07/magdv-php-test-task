<?php

declare(strict_types=1);

namespace App\Tests\Document\ValueObjects;

use PHPUnit\Framework\TestCase;
use App\Document\ValueObjects\StatusVO;

class StatusVOTest extends TestCase
{

    /**
     * @return void
     */
    public function testSuccessCreate(): void
    {
        foreach (StatusVO::STATUSES as $expected) {
            $actual = new StatusVO($expected);

            $this->assertEquals($expected, $actual);
        }
    }

    /**
     * @return void
     */
    public function testEquals(): void
    {
        $statusOne = new StatusVO(StatusVO::DRAFT);
        $statusTwo = new StatusVO('dRaFt');

        $this->assertEquals(true, $statusOne->equals($statusTwo));

        $statusOne = new StatusVO(StatusVO::DRAFT);
        $statusTwo = new StatusVO(StatusVO::PUBLISHED);

        $this->assertEquals(false, $statusOne->equals($statusTwo));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage  is not valid status
     * @return void
     */
    public function testEmptyFailedCreate(): void
    {
        new StatusVO('');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage test is not valid status
     * @return void
     */
    public function testFailedCreate(): void
    {
        new StatusVO('Test');
    }
}
