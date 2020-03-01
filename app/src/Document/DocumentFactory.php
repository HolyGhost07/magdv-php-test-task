<?php

declare(strict_types=1);

namespace App\Document;

use InvalidArgumentException;
use App\Document\ValueObjects\StatusVO;
use App\Document\ValueObjects\PayloadVO;

class DocumentFactory
{

    /**
     * @return Document
     * @throws InvalidArgumentException
     */
    public function createDraft(): Document
    {
        return new Document(
            new StatusVO(StatusVO::DRAFT),
            new PayloadVO()
        );
    }
}
