<?php

declare(strict_types=1);

namespace App\Document;

use App\Document\ValueObjects\StatusVO;
use App\Document\ValueObjects\PayloadVO;

class DocumentFactory
{

    /**
     * @return Document
     */
    public function createDraft(): Document
    {
        return new Document(
            new StatusVO(StatusVO::DRAFT),
            new PayloadVO()
        );
    }
}