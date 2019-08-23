<?php

declare(strict_types=1);

namespace App\Document\Providers;

use Pimple\Container;
use App\Document\DocumentEntity;
use App\Document\DocumentFactory;
use App\Document\DocumentService;
use App\Document\DocumentSqlStore;
use Pimple\ServiceProviderInterface;

class DocumentServicesProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function register(Container $pimple)
    {
        $pimple[DocumentFactory::class] = function (Container $container) {
            return new DocumentFactory();
        };

        $pimple[DocumentService::class] = function (Container $container) {
            return new DocumentService(
                $container[DocumentFactory::class],
                new DocumentSqlStore($container['EntityManager'])
            );
        };
    }
}
