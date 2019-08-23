<?php

declare(strict_types=1);

namespace App\Document;

use App\Document\ValueObjects\StatusVO;
use App\Document\ValueObjects\PayloadVO;

class DocumentFactory
{

    /**
     * @return DocumentEntity
     */
    public function createDraft(): DocumentEntity
    {
        return new DocumentEntity(
            new StatusVO(StatusVO::DRAFT),
            new PayloadVO()
        );
    }
}